<template>
  <v-app id="inspire">
    <v-content>
  <v-container fluid>
    <v-row>
      <v-col cols="12">
        <v-row
          :align="alignment"
          :justify="justify"
          class="grey lighten-5"
          style="height: 300px;"
        >
          <v-card
            v-for="n in 3"
            :key="n"
            class="ma-3 pa-6"
            outlined
            tile
          >
            Column
          </v-card>
        </v-row>
      </v-col>
    </v-row>
    <div class="categoriesSearch">
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <div v-if="error" class="error">
            {{ error }}
        </div>

        <ul v-if="categoriesSearch">
            <li v-for="categorySearch in categoriesSearch">
                <strong>Name:</strong> {{ categorySearch.results}},
            </li>
        </ul>
    </div>

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
            categoriesSearch: null,
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
                  this.categoriesSearch = response.data;
                  console.log(this.categoriesSearch);
                })
                .catch(response => {
                  console.log(response.data.error)
                })
                .finally(() => this.loading = false)
        }
    }
}
</script>
