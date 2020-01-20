<template>
  <v-container>
      <v-form
    ref="form"
    v-model="valid"
    lazy-validation
    @submit.prevent="login"
  >
    <v-text-field
      v-model="form.email"
      :rules="emailRules"
      type="email"
      label="E-mail"
      required
    ></v-text-field>

    <v-text-field
      v-model="form.password"
      :counter="10"
      :rules="passwordRules"
      type="password"
      label="Password"
      required
    ></v-text-field>


    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      type="submit"
      @click="validate"
    >
      Login
    </v-btn>

  </v-form>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      valid: true,
      password: '',
      passwordRules: [
        v => !!v || 'Password is required',
        v => (v && v.length <= 10) || 'Password must be less than 10 characters',
      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      form:{
          email:null,
          password:null
      },
    }),

    methods: {
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
        }
      },
      reset () {
        this.$refs.form.reset()
      },
      resetValidation () {
        this.$refs.form.resetValidation()
      },
      login(){
          axios.post('/api/auth/login', this.form)
          .then((result) => {
              console.log(result.data)
          }).catch((err) => {
              console.error(err)
          });
      }
    },
  }
</script>
<style lang="scss" scoped>

</style>
