export const auth = $state({
    user: null as any,
    token: null as string | null,
    
    login(userData: any, token: string) {
        this.user = userData;
        this.token = token;
        localStorage.setItem('safe_user', JSON.stringify(userData));
        localStorage.setItem('safe_token', token);
    },

    logout() {
        this.user = null;
        this.token = null;
        localStorage.removeItem('safe_user');
        localStorage.removeItem('safe_token');
    },

    init() {
        const storedUser = localStorage.getItem('safe_user');
        const storedToken = localStorage.getItem('safe_token');
        if (storedUser && storedToken) {
            this.user = JSON.parse(storedUser);
            this.token = storedToken;
        }
    }
});
