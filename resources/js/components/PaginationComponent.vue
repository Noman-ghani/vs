<template>
    <nav class="d-flex justify-content-between pagination is-centered is-rounded" role="navigation" aria-label="pagination">
        <span>
            <button class="btn btn-success  pagination-previous" @click.prevent="changePage(1)" :disabled="pagination.current_page <= 1">First page</button>
            <button class="btn btn-success pagination-previous" @click.prevent="changePage(pagination.current_page - 1)" :disabled="pagination.current_page <= 1">Previous</button>
        </span>
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <button v-for="page in pages" class="btn pagination-link" :class="isCurrentPage(page) ? 'is-current btn-success' : 'btn-outline-success'" @click.prevent="changePage(page)">{{ page }}</button>
        </div>
        <span>
            <button class="btn btn-success pagination-next" @click.prevent="changePage(pagination.current_page + 1)" :disabled="pagination.current_page >= pagination.last_page">Next page</button>
            <button class="btn btn-success pagination-next" @click.prevent="changePage(pagination.last_page)" :disabled="pagination.current_page >= pagination.last_page">Last page</button>
        </span>
    </nav>
</template>

<style>
    .pagination {
        margin: 40px 0 ;
    }
    .pagination .btn{text-transform: capitalize;}
</style>

<script>
    export default {
        props: ['pagination', 'offset'],
        methods: {
            isCurrentPage(page) {
                return this.pagination.current_page === page;
            },
            changePage(page) {
                if (page > this.pagination.last_page) {
                    page = this.pagination.last_page;
                }
                console.log(page);
                
                this.$router.push({ query: { page: page}})
                this.$emit('paginate');
            }
        },
        computed: {
            pages() {
                let pages = [];
                let from = this.pagination.current_page - Math.floor(this.offset / 2);
                if (from < 1) {
                    from = 1;
                }
                let to = from + this.offset - 1;
                if (to > this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                while (from <= to) {
                    pages.push(from);
                    from++;
                }
                return pages;
            }
        }
    }
</script>