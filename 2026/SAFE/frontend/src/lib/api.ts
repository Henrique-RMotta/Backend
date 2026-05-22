const BASE_URL = 'http://localhost:8000/api';

export async function apiFetch(endpoint: string, method = 'GET', body?: any) {
    const options: RequestInit = {
        method,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    };

    if (body) {
        options.body = JSON.stringify(body);
    }

    const response = await fetch(`${BASE_URL}${endpoint}`, options);
    
    if (!response.ok) {
        const error = await response.json();
        throw new Error(error.message || 'Erro na requisição');
    }

    return response.json();
}
