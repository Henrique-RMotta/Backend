<script lang="ts">
    import { auth } from '$lib/auth.svelte';
    import { goto } from '$app/navigation';
    import { onMount } from 'svelte';

    onMount(() => {
        if (!auth.user) goto('/login');
        else if (auth.user.role === 'aqv') goto('/aqv');
        else if (auth.user.role === 'portaria') goto('/portaria');
    });
</script>
