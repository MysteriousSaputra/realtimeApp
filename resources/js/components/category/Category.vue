<template>
 <div>
    <v-card
        class="mx-auto"
        max-width="90%"
    >
        <v-container>
            <v-form
            ref="form"
            lazy-validation
            @submit.prevent="submitCategory"
            >
            <v-text-field
            v-model="form.name"
            type="text"
            label="Category"
            required
            autocomplete="off"
            ></v-text-field>


            <div v-if="editSlug">

            <v-btn
            color="primary"
            class="mr-4"
            type="submit"
            >
            Update
            </v-btn>

            <v-btn
            color="error"
            class="mr-4"
            @click="cancelEdit"
            >
            Cancel
            </v-btn>
            </div>
            <div v-else>

            <v-btn
            color="success"
            class="mr-4"
            type="submit"
            >
            Create
            </v-btn>
            </div>

            </v-form>
        </v-container>
    </v-card><br>

    <!-- list category -->
    <v-card
        class="mx-auto"
        max-width="90%"
    >

    <v-toolbar dense>
      <v-toolbar-title>List Category</v-toolbar-title>
    </v-toolbar>

    <v-list>
      <v-list-item
        v-for="(category, index) in categories"
        :key="category.id"
      >
        <v-list-item-icon>
          <v-icon color="pink">mdi-star</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title v-text="category.name"></v-list-item-title>
        </v-list-item-content>

        <div>
            <v-btn icon>
            <v-icon color="orange" @click="editCategory(index)">mdi-pencil</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon color="red" @click="deleteCategory(category.slug, index)">mdi-delete</v-icon>
            </v-btn>
        </div>

      </v-list-item>
    </v-list>

    </v-card><br>
 </div>

</template>

<script>
    export default {
        data(){
            return {
                form:{
                    name:null
                },
                categories:{},
                editSlug:null,
                dataCategori:null
            }
        },
        methods:{
            cancelEdit(){
                this.form.name = null;
                this.editSlug = null;
            },
            getCategory(){
                axios.get('/api/category')
                .then((result) => {
                    // console.log(result)
                    this.categories = result.data.data
                }).catch((err) => {
                    console.log(err)
                });
            },
            editCategory(index){
                this.form.name = this.categories[index].name
                this.editSlug = this.categories[index].slug
                this.getCategory();
            },
            submitCategory(){
                this.editSlug ? this.updataCategory() : this.createCategory();
            },
            createCategory(){
                axios.post('/api/category', this.form)
                .then((result) => {
                    this.categories.unshift(result.data);
                    this.form.name = null;
                }).catch((err) => {
                    console.log(err)
                });
            },
            updataCategory(){
                axios.put(`/api/category/${this.editSlug}`, this.form)
                .then((result) => {
                    this.form.name = null;
                    this.categories = result.data;
                    this.editSlug = null;
                    // console.log(result)
                }).catch((err) => {
                    console.log(err)
                });
            },
            deleteCategory(slug, index){
                this.$swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                       axios.delete(`/api/category/${slug}`)
                        .then((result) => {
                            this.categories.splice(index, 1)
                            this.$swal.fire(
                            'Deleted!',
                            'Your category has been deleted.',
                            'success'
                            )
                        }).catch((err) => {
                            console.log(err)
                        });

                    }
            })
            }
        },
        created(){
            if (!User.admin()) {
                this.$router.push('/forum');
            }else{
                this.getCategory();
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
