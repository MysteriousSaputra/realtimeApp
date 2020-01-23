<template>
 <div>
    <v-card
        class="mx-auto"
        max-width="90%"
    >
        <v-container>

            <reply
            v-for="(reply, index) in replies"
            :key="index"
            :data="reply"
            :index="index"
            ></reply>

        </v-container>
    </v-card>
 </div>
</template>

<script>
import Reply from './Reply';

    export default {
        props:['replies'],
        data(){
            return{
                content:this.replies
            }
        },
        components:{
            Reply
        },
        created(){
            this.listen()
        },
        methods:{
            listen(){
                EventBus.$on('createReply', (reply) => {
                    this.replies.unshift(reply)
                })


                EventBus.$on('deleteReply', (indexnya) => {
                    this.replies.splice(indexnya, 1)
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
