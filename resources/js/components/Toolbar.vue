<template>
  <v-card
    color="grey lighten-4"
    flat
    height="60px"
    tile
  >
    <v-toolbar dense>

      <v-toolbar-title>Forum Programmer</v-toolbar-title>

      <v-spacer></v-spacer>
      <notification
      v-if="isLogin"></notification>


        <router-link
        v-for="item in items"
        :key="item.title"
        v-bind:to="{name: item.to}"
        >
        <div class="my-2" v-if="item.show">
            <v-btn text small>{{item.title}}</v-btn>
        </div>
        </router-link>

          <!-- <v-menu bottom left>
            <template v-slot:activator="{ on }">
              <v-btn
                icon
                v-on="on"
              >
                <v-icon>mdi-dots-vertical</v-icon>
              </v-btn>
            </template>

            <v-list>
              <v-list-item
                v-for="(item, i) in items"
                :key="i"
                :to="item.to"
              >
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu> -->
    </v-toolbar>
  </v-card>
</template>
<script>
import Notification from './AppNotification';
  export default {
    created(){
        EventBus.$on('logout', () => {
            User.logout();
        })
    },
    components:{
        Notification
    },
    data(){
        return {

        items: [
            { title: 'Forum', to: 'forum', show:true  },
            { title: 'Ask Quetion', to: 'askQuetion', show:User.logedin()},
            { title: 'Category', to: 'category', show:User.admin()},
            { title: 'Login', to: 'login', show:!User.logedin() },
            { title: 'Logout', to: 'logout', show:User.logedin() },
        ],
            isLogin:User.logedin()
        }
    }
  }
</script>

<style lang="scss" scoped>

</style>
