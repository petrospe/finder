<template>
  <v-app id="inspire">
    <v-content>
  <v-container fluid>
    <v-row>
      <v-col cols="12" class="categoriesSearch">
        <v-row
          :align="alignment"
          :justify="justify"
          class="grey lighten-5 loading"
          style="height: 300px;"
          v-if="loading"
        >
          <v-card>Loading...</v-card>
        </v-row>
        <v-row
          :align="alignment"
          :justify="justify"
          class="grey lighten-5 error"
          style="height: 300px;"
          v-if="error"
        >
          <v-card>
            {{ error }}
            <button @click.prevent="fetchData">
              Try Again
            </button>
          </v-card>
        </v-row>
        <v-row
          :align="alignment"
          :justify="justify"
          class="grey lighten-5"
          style="height: 300px;"
        >
          <v-card
            v-for="categorySearch in categoriesSearch"
            :key="categorySearch.id"
            class="ma-3 pa-6"
            outlined
            tile
          >
          <div class="title">
            <router-link :to="{ name: 'items.search', params: { categoryid: categorySearch.id }}">{{ categorySearch.attributes.name}}</router-link>
          </div>
          <div class="subtitle-1">
            {{ categorySearch.attributes.description}}
          </div>
          </v-card>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</v-content>
</v-app>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            alignment: 'center',
            dense: false,
            justify: 'center',
            loading: false,
            categoriesSearch: [],
            error: null
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
                  this.loading = false;
                  this.categoriesSearch = JSON.parse(JSON.stringify(response.data)).data.results;
                  console.log(this.categoriesSearch);
                  // debugger;
                })
                .catch(error => {
                  this.loading = false;
                  this.error = error.response.data.message || error.message;
                })
                // .finally(() => this.loading = false)
        }
    }
}
</script>
