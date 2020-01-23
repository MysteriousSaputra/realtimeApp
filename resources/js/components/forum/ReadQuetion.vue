<template>

    <div>
        <edit-quetion
        v-if="editing"
        :data="quetion">

        </edit-quetion>

        <div v-else>

            <show-quetion
            :data="quetion"
            v-if="quetion">
            </show-quetion>

        </div>

        <replies-quetion
        :replies="quetion.replies"
        ></replies-quetion><br>

        <reply-quetion
        :quetionSlug="quetion">
        </reply-quetion>

    </div>


</template>

<script>
import ShowQuetion from './ShowQuetion';
import EditQuetion from './EditQuetion';
import RepliesQuetion from '../reply/Replies';
import ReplyQuetion from '../reply/CreateReply';

    export default {
        components:{
            ShowQuetion,
            EditQuetion,
            RepliesQuetion,
            ReplyQuetion
        },
        data(){
            return{
                quetion:'',
                editing:false,
            }
        },
        created(){
            this.listen();
            this.getQuetion();
        },
        methods:{
            getQuetion(){
                axios.get(`/api/quetion/${this.$route.params.slug}`)
                .then((result) => {
                    this.quetion = result.data.data
                }).catch((err) => {
                    // console.error(err);
                });
            },
            listen(){
                EventBus.$on('startEditing', () => {
                    this.editing = true
                })

                EventBus.$on('cancelEditing', () => {
                    this.editing = false
                })
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
