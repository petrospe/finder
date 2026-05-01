<template>
<v-row class="p-4">
  <v-col cols="12" class="itemsSearch m-4">
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
      v-if="!loading && !error && itemsSearch && itemsSearch.length"
    >
      <v-card
        v-for="itemSearch in itemsSearch"
        :key="itemSearch.id"
        class="col-6"
        outlined
        tile
      >
      <v-card-title class="grey--text text--darken-4">Search Criteria</v-card-title>

          <v-form>
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
        </v-form>

      </v-card>
    </v-row>
    <v-row
      :align="alignment"
      :justify="justify"
      class="grey lighten-5"
      style="height: 300px;"
      v-if="!loading && !error && (!itemsSearch || !itemsSearch.length)"
    >
      <v-card class="pa-4">
        No search fields found for this category.
      </v-card>
    </v-row>
  </v-col>
</v-row>
</template>
<script>
import axios from 'axios'

export default {
    metaInfo () {
      return { title: this.$t('items_search') }
    },
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
            this.error = null;
            this.itemsSearch = [];
            this.loading = true;
            axios
                .get('/api/items/'+this.categoryid+'/search')
                .then(response => {
                  this.itemsSearch = response?.data?.data?.results || [];
                })
                .catch(error => {
                  const apiMessage = error?.response?.data?.message;
                  this.error = apiMessage || error.message || 'Failed to load search fields.';
                })
                .finally(() => this.loading = false)
        },
        clear(){
        },
        submit(){
        }
    }
}
</script>
