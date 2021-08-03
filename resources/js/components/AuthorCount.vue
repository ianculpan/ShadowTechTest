<template>
    <div id="app">
        <select id="authors" @change="getCount($event)">
            <option disabled="disabled" selected="selected">--Please select an author--</option>
            <option v-for="author in this.authors">
                {{author}}
            </option>
        </select>
        <div>
            Count of books {{this.count.count}}
        </div>
    </div>
</template>

<script>
export default {

    name: "BookCount",
    data() {
        return {
            authors: [],
            count: 0
        }
    },
    methods: {
      getCount(event){
            axios.get('/api/count?authorName='+event.target.value)
                .then(
                    response => {
                        this.count = response.data[0];
                    }
                )
        }
    },
    created() {
        axios.get('/api/authors')
            .then(
                response => {
                    this.authors = response.data;
                }
            )
    },

}
</script>

<style scoped>
</style>
