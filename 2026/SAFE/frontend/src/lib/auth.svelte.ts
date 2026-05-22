import { goto } from '$app/navigation';
import { browser } from '$app/environment';

export const auth = $state({
    user: browser && localStorage.getItem('safe_user') ? JSON.parse(localStorage.getItem('safe_user')!) : null,

    login(userData: any) {
        this.user = userData;
        localStorage.setItem('safe_user', JSON.stringify(userData));
    },

    logout() {
        this.user = null;
        localStorage.removeItem('safe_user');
        goto('/login');
    }
});
