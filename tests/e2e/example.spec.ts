import { test, expect } from '@playwright/test';
import { csrfToken, login } from '../laravel-playwright/helpers';

test('Can grab the CSRF token', async ({ page }) => {
    const response = await csrfToken({ page });
    expect(response).toBeDefined();
});

test('Can create a new user and log them in', async ({ page }) => {
    const user1 = await login({
        page,
        attributes: {
            name: 'Yoann',
            email: 'yoann@web-id.fr',
        },
    });

    expect(user1).toMatchObject({
        id: 1,
        name: 'Yoann',
        email: 'yoann@web-id.fr',
    });
});
