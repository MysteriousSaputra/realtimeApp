<template>
    <div>

        <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn
          v-on="on"
          text small
        >
        <v-icon color="red">mdi-bell</v-icon>{{unreadCount}}
        </v-btn>
      </template>
      <v-list
          v-for="(item, index) in unread"
          :key="index">
        <router-link
        :to="item.path">
            <v-list-item>
                <v-list-item-title @click="readNotif(item.id)">{{item.quetion}}</v-list-item-title>
            </v-list-item>
        </router-link>
      </v-list>
    </v-menu>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                read:{},
                unread:{},
                unreadCount:0
            }
        },
        created(){
            if (User.logedin()) {
                this.getNotification();
            }
        },
        methods:{
            getNotification(){
                axios.post('/api/notification')
                .then((result) => {
                    this.read = result.data.read
                    this.unread = result.data.unreadNotif.filter(data => data.dlt == 0);
                    this.unreadCount = result.data.unreadNotif.filter(data => data.dlt == 0).length
                    console.log(result.data.unreadNotif)
                }).catch((err) => {
                    console.error(err)
                });
            },
            readNotif(data){
                axios.put(`/api/readednotification/${data}`)
                .then((result) => {
                    console.log(result)
                }).catch((err) => {
                    console.error(err)
                });
            }
        }

    }
</script>

<style lang="scss" scoped>

</style>
