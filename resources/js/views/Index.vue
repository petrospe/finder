<template>
    <div>
        <p>
            <router-link :to="{ name: 'Login' }">Login</router-link> |
            <router-link :to="{ name: 'categories.search' }">Find</router-link> |
            <router-link :to="{ name: 'Entry' }">New Entry</router-link> |
        </p>
    </div>
</template>
<script>
    export default {}
</script>
