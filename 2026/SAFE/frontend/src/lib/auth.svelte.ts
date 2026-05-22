import { goto } from '$app/navigation';
import { browser } from '$app/environment';

export const auth = {
    get user() {
        if (!browser) return null;
        const u = localStorage.getItem('safe_user');
        return u ? JSON.parse(u) : null;
    },

    login(userData: any) {
        localStorage.setItem('safe_user', JSON.stringify(userData));
    },

    logout() {
        localStorage.removeItem('safe_user');
        goto('/login');
    }
};
