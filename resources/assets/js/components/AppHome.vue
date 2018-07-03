<template>
    <div>
        <!-- New Modal -->
        <app-new :active="addActive" @added="added"  @cancel="addActive = false"></app-new>
        <!-- End New Modal -->

        <!-- Show Modal -->
        <app-show :active="showActive" @cancel="showActive = false"></app-show>
        <!-- Show New Modal -->

        <!-- Edit Modal -->
        <app-edit :active="editActive" @edited="edited" @cancel="editActive = false"></app-edit>
        <!-- Edit Modal -->

        <nav class="panel column is-offset-2 is-8" >
            <p class="panel-heading">
                Phonebook
                <button class="button is-link is-small" @click="addActive = true">
                    <span class="icon">
                        <i class="fas fa-plus"></i>
                    </span>
                </button>
                <span class="is-pulled-right" v-if="loading">
                    <i class="fas fa-spinner fa-lg fa-pulse"></i>
                </span>
            </p>
            <div class="panel-block">
                <p class="control has-icons-left">
                    <input v-model="searchQuery" class="input is-small" type="text" placeholder="search">
                    <span class="icon is-small is-left">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </span>
                </p>
            </div>

            <ul>
                <li class="panel-block is-active" v-for="(phonebook, index) in temp" :key="phonebook.id">
                    <span class="column is-9" v-text="phonebook.name"></span>
                    <span class="has-text-danger panel-icon column is-1">
                        <i class="fas fa-trash" @click="deleteEvent(index)"></i>
                    </span>
                        <span class="has-text-success panel-icon column is-1">
                        <i class="fas fa-edit" @click="editEvent(index)"></i>
                    </span>
                        <span class="panel-icon column is-1">
                        <i class="fas fa-eye" @click="showEvent(index)"></i>
                    </span>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>

    import AppNew from './AppNew.vue'
    import AppShow from './AppShow.vue'
    import AppEdit from './AppEdit.vue'

    export default {
        components: {
            'app-new' : AppNew,
            'app-show' : AppShow,
            'app-edit' : AppEdit,
        },
        data () {
            return {
                addActive: false,
                showActive: false,
                editActive: false,
                data: [],
                showData: false,
                loading: false,
                searchQuery: '',
                temp: {},
            };
        },
        watch: {
            searchQuery () {
                if(this.searchQuery.length > 0)
                {
                    // TODO:: check this
                    this.temp = this.data.filter(function(item){
                        return Object.keys(item).some(function (key){
                            let string =  String(item[key]);
                            return string.toLowerCase().indexOf(this.searchQuery.toLowerCase()) > -1;
                        }.bind(this));
                    }.bind(this));

                } else {
                    this.temp = this.data;
                }
            }
        },
        methods: {

            added (response) {
                this.data.push(response.data);
                // TODO:: check this
                this.data.sort(function (a, b) {
                    if(a.name > b.name) return 1;
                    else if(a.name < b.name) return -1;
                });
            },
            edited () {
                this.getData();
            },
            showEvent (index) {
                this.showActive = true;
                this.$children[1].data = this.temp[index];
            },
            editEvent (index) {
                this.editActive = true;
                this.$children[2].data = this.temp[index];
            },
            deleteEvent (index) {
                if(!confirm('Are you sure?')) return false;
                this.loading = true;
                axios
                    .delete(`/phonebook/${this.data[index].id}`)
                    .then(function () {
                        this.data.splice(index, 1);
                        this.loading = false;
                    }.bind(this))
            },
            getData () {
                axios
                    .get('/phonebook')
                    .then(function (response) {
                        this.data = this.temp = response.data; // by reference
                    }.bind(this));
            }
        },
        created () {
            this.getData();
            // console.dir(this.data);
        }
    }
</script>

<style scoped>
    i{
        cursor: pointer;
    }
</style>