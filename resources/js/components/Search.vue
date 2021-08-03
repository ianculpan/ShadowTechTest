<template>
    <div class="mr-2">
        <p>Books Search Page</p>

        <input v-model="filter" placeholder="filter">
<!--        <input v-model="filterPublicationDate" placeholder="filter by publication date">-->
<!--        <input v-model="filterBookTitle" placeholder="filter by book title">-->

        <table>
            <thead>
                <tr>
                    <th>
                        Isbn
                    </th>
                    <th>
                        Qty
                    </th>
                    <th>
                        Author
                    </th>
                    <th>
                        Book Title
                    </th>
                    <th>
                        Published Year
                    </th>
                </tr>
            </thead>
            <tbody>
            <tr class="odd:bg-purple-200 even:bg-gray-200"
                v-for="(book, index) in filteredBooks">
                <td>{{book.isbn}}</td>
                <td>{{book.books_count}}</td>
                <td>{{book.authors}}</td>
                <td>{{book.original_title}}</td>
                <td>{{book.original_publication_year}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            filter: "",
            books: [],
        }
    },
    created() {
        axios.get('/api/books')
            .then(
                response => {
                    this.books = response.data;
                }
            )
    },
    computed: {
        filteredBooks(){
            return this.books.filter(book=> {
                const authors = book.authors.toString().toLowerCase();
                const original_title = book.original_title.toString().toLowerCase();
                const years = book.original_publication_year.toString().toLowerCase();

                const searchTerm = this.filter.toLowerCase();

                return authors.includes(searchTerm) || original_title.includes(searchTerm) || years.includes(searchTerm);
                }
            )
        }
    }
}
</script>

<style scoped>

</style>
