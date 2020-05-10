<template>
  <v-app id="inspire">
    <v-content>
  <v-container fluid>
    <v-row>
      <v-col cols="12" class="itemsSearch">
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
            v-for="itemSearch in itemsSearch"
            :key="itemSearch.id"
            class="ma-3 pa-6"
            outlined
            tile
          >
          <v-card-title class="grey--text text--darken-4">Search Criteria</v-card-title>

              <form>
              <div v-for="(attribute,i) in itemSearch.attributes">
                <!-- {{ attributes }} -->
                  <v-text-field
                    v-if="itemSearch.attributes[i] !== 1"
                    v-bind:label="itemSearch.attributes[i]"
                    required
                  ></v-text-field>
              </div>
              <v-btn class="mr-4" @click="submit">submit</v-btn>
              <v-btn @click="clear">clear</v-btn>
              </form>

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
            itemsSearch: [],
            error: null,
            categoryid: 0,
            attribute:[]
        };
    },
    created() {
        this.categoryid = this.$route.params.categoryid;
        this.fetchData();
    },
    methods: {
        navigate() {
          router.go(-1);
        },
        fetchData() {
            this.error = this.itemsSearch = null;
            this.loading = true;
            axios
                .get('/api/items/'+this.categoryid+'/search')
                .then(response => {
                  this.loading = false;
                  this.itemsSearch = JSON.parse(JSON.stringify(response.data)).data.results;
                  // console.log(categoryid);
                  // debugger;
                })
                .catch(error => {
                  this.loading = false;
                  this.error = error.response.data.message || error.message;
                })
                // .finally(() => this.loading = false)
        },
        clear(){
        },
        submit(){
        }
    }
}
</script>
