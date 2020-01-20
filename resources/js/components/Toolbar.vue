<template>
  <v-card
    color="grey lighten-4"
    flat
    height="60px"
    tile
  >
    <v-toolbar dense>

      <v-toolbar-title>Title</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>


          <v-menu bottom left>
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
                :to="item.slug"
              >
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
    </v-toolbar>
  </v-card>
</template>
<script>
  export default {
    data: () => ({
      items: [
        { title: 'Forum', slug: 'forum'  },
        { title: 'Ask Quetion', slug: 'quetion'  },
        { title: 'Category', slug: 'category'  },
        { title: 'Login', slug: 'login' },
      ],
    }),
  }
</script>

<style lang="scss" scoped>

</style>
