<template>
  <div>
      <v-card
    class="mx-auto"
    color="#26c6da"
    dark
  >
    <v-card-title>
      <v-icon
        large
        left
      >
        mdi-account
      </v-icon>
      <span class="title font-weight-light">{{data.name}}</span>
    </v-card-title>


    <v-card-text  class="headline" v-if="isEditReply">
        <edit-reply :data="data"></edit-reply>
    </v-card-text>
    <v-card-text class="headline" v-html="reply" v-else></v-card-text>

    <v-card-actions>
      <v-list-item class="grow">

        <v-list-item-content>
          <v-list-item-title>{{data.created_at}}</v-list-item-title>
        </v-list-item-content>

        <v-row
          align="center"
          justify="end"
        >
        <like-reply :content="data"></like-reply>



        <div v-if="!isEditReply">
            <div v-if="replies">
            <v-btn icon>
            <v-icon color="white" @click="editReply">mdi-pencil</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon color="white" @click="deleteReply">mdi-delete</v-icon>
            </v-btn>
        </div>
        </div>
        </v-row>
      </v-list-item>
    </v-card-actions>
  </v-card><br>
  </div>
</template>

<script>
import EditReply from '../reply/EditReply';
import likeReply from '../like/like';

    export default {
        components:{
            EditReply,
            likeReply
        },
        data: () => ({

        }),
        data(){
            return {
                isEditReply:false,
                cancelBody:''
            }
        },
        props:['data', 'index'],
        computed:{
            replies(){
                return User.own(this.data.user_id)
            },
            reply(){
                return md.parse(this.data.reply);
            },
        },
        created(){
            this.listen()
        },
        methods:{
            deleteReply(){
                axios.delete(`/api/quetion/${this.data.quetion}/reply/${this.data.id}`)
                .then((result) => {
                   EventBus.$emit('deleteReply', this.index)
                }).catch((err) => {
                    console.log(err)
                });
            },
            editReply(){
                this.isEditReply = true
            },
            listen(){
                EventBus.$on('cancelEditReply', () => {
                    this.isEditReply = false

                })
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
