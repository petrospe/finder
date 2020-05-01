<template>
    <div class="categoriesSearch">
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <div v-if="error" class="error">
            {{ error }}
        </div>

        <ul v-if="categoriesSearch">
            <li v-for="{ name, desciption } in categoriesSearch">
                <strong>Name:</strong> {{ name }},
                <strong>Desciption:</strong> {{ desciption }}
            </li>
        </ul>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            loading: false,
            categoriesSearch: null,
            error: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.categoriesSearch = null;
            this.loading = true;
            axios
                .get('/api/categories/search')
                .then(response => {
                    console.log(response.data);
                });
        }
    }
}
</script>
