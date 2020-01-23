<template>
 <div>
      <v-card
    class="mx-auto"
    max-width="90%"
  >

    <v-card-title>
        {{data.title}}
    </v-card-title>

    <v-card-subtitle>
       <div>{{data.user}} said {{data.created_at}}</div>
    </v-card-subtitle>


    <v-card-text v-html="body"></v-card-text>

    <v-card-actions>
      <!-- <v-btn
        color="primary"
      >
        5 Replies
      </v-btn> -->

      <!-- <v-btn
        color="orange"
        text
      >
        Explore
      </v-btn> -->

        <div v-if="own">
            <v-btn icon>
            <v-icon color="orange" @click="edit">mdi-pencil</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon color="red" @click="destroy">mdi-delete</v-icon>
            </v-btn>
        </div>

      <v-spacer></v-spacer>
      <v-btn color="primary" dark>{{data.reply_count}} replies</v-btn>
    </v-card-actions>


  </v-card><br>
 </div>
</template>

<script>
    export default {
        props:['data'],
        // created(){

        //         console.log(this.data.user_id)
        // },
        data(){
            return {
                own: User.own(this.data.user_id)
            }

        },
        computed:{
            body(){
                return md.parse(this.data.body)
            }
        },
        methods:{
            destroy(){
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
                        axios.delete(`/api/quetion/${this.data.slug}`)
                        .then((result) => {
                            this.$router.push('/forum')
                        }).catch((err) => {
                            console.error(err)
                        });
                        this.$swal.fire(
                        'Deleted!',
                        'Your quetion has been deleted.',
                        'success'
                        )
                    }
                })
            },
            edit(){
                EventBus.$emit('startEditing');
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
