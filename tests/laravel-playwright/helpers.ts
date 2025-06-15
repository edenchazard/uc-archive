import { Page } from '@playwright/test';

export async function csrfToken({ page }: { page: Page }) {
    const response = await page.request.get('/__playwright__/csrf_token', {
        headers: { Accept: 'application/json' },
    });
    return await response.json();
}

/**
 * Create a new user and log them in.
 *
 * @example login({page})
 *          login({page, attributes: {email: 'yoann@web-id.fr'}})
 *          login({page, attributes: {email: 'new@user.fr', name: 'New user'}})
 */
export async function login({
    page,
    attributes,
}: {
    page: Page;
    attributes?: object;
}) {
    const token = await csrfToken({ page });

    const response = await page.request.post('/__playwright__/login', {
        headers: { Accept: 'application/json' },
        data: {
            _token: token,
            attributes,
        },
    });
    return await response.json();
}

/**
 * Fetch the currently authenticated user object.
 *
 * @example currentUser({page})
 */
export async function currentUser({ page }: { page: Page }) {
    const token = await csrfToken({ page });
    const response = await page.request.post('/__playwright__/current-user', {
        headers: { Accept: 'application/json' },
        data: { _token: token },
    });
    const body = await response.text();
    if (!body) {
        console.log('No authenticated user found.');
        return null;
    }
    return await response.json();
}

/**
 * Logout the current user.
 *
 * @example logout({page})
 */
export async function logout({ page }: { page: Page }) {
    const token = await csrfToken({ page });
    const response = await page.request.post('/__playwright__/logout', {
        headers: { Accept: 'application/json' },
        data: { _token: token },
    });
    console.log(await response.text());
    return await response.text();
}

/**
 * Create a new Eloquent factory.
 *
 * @param {String} model
 * @param {Number|null} times
 * @param {Object} attributes
 *
 * @example create({page, model: 'App\\Models\\User'});
 *          create({page, model: 'App\\Models\\User', count: 2});
 *          create({page, model: 'App\\Models\\User', attributes: { active: false }});
 *          create({page, model: 'App\\Models\\User', count: 2, attributes: { active: false }});
 *          create({page, model: 'App\\Models\\User', count: 2, attributes: { active: false }, load: ['profile']});
 *          create({page, model: 'App\\Models\\User', count: 2, attributes: { active: false }, load: ['profile'], state: ['guest']});
 *          create({page, model: 'App\\Models\\User', attributes: { active: false }, load: ['profile']);
 *          create({page, model: 'App\\Models\\User', attributes: { active: false }, load: ['profile'], ['guest']);
 *          create({page, model: 'App\\Models\\User', load: ['profile']});
 *          create({page, model: 'App\\Models\\User', load: ['profile'], state: ['guest']});
 */
export async function create({
    page,
    model,
    count = 1,
    attributes = {},
    load = [],
    state = [],
}: {
    page: Page;
    model: string;
    count?: number;
    attributes?: object;
    load?: string[];
    state?: string[];
}) {
    const token = await csrfToken({ page });
    const response = await page.request.post('/__playwright__/factory', {
        headers: { Accept: 'application/json' },
        data: { _token: token, model, count, attributes, load, state },
    });
    return await response.json();
}

/**
 * Trigger an Artisan command.
 *
 * @example artisan({page, command: 'cache:clear'});
 */
export async function artisan({
    page,
    command,
    parameters = {},
}: {
    page: Page;
    command: string;
    parameters: object;
}) {
    const token = await csrfToken({ page });
    console.log(
        [
            command,
            Object.entries(parameters)
                .map(([k, v]) => `${k}="${v}"`)
                .join(' '),
        ].join(' '),
    );
    return await page.request.post('/__playwright__/artisan', {
        headers: { Accept: 'application/json' },
        data: { _token: token, command, parameters },
    });
}

/**
 * Refresh the database state.
 **
 * @example refreshDatabase({page});
 *          refreshDatabase({page, parameters: {'--drop-views': true}});
 */
export async function refreshDatabase({
    page,
    parameters = {},
}: {
    page: Page;
    parameters?: object;
}) {
    return await artisan({ page, command: 'migrate:fresh', parameters });
}

/**
 * Seed the database.
 *
 * @example seed({page});
 *          seed({page, seederClass: 'PlansTableSeeder'});
 */
export async function seed({
    page,
    seederClass = '',
}: {
    page: Page;
    seederClass?: string;
}) {
    const parameters = {};

    if (seederClass) {
        parameters['--class'] = seederClass;
    }
    return await artisan({ page, command: 'db:seed', parameters });
}

/**
 * Execute arbitrary PHP.
 *
 *
 * @example php({page, command: '2 + 2'})
 *          php({page, command: 'App\\Model\\User::count()'})
 */
export async function php({ page, command }: { page: Page; command: string }) {
    const token = await csrfToken({ page });
    const response = await page.request.post('/__playwright__/run-php', {
        headers: { Accept: 'application/json' },
        data: { _token: token, command },
    });
    const json = await response.json();
    return json.result ?? json;
}
