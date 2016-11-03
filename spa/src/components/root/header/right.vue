<template lang="html">
  <div>
    <ul class="nav navbar-nav navbar-right">
      <router-link tag="li" :to="{ name: 'auth.signin' }" v-if="!isLogged" exact><a>Sign in</a></router-link>
      <router-link tag="li" :to="{ name: 'auth.signup' }" v-if="!isLogged" exact><a>Get an Account</a></router-link>
      <li class="dropdown" :class="{ open: isDropdownUserOpen }" v-if="isLogged">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" @click="dropdownToggle()">
          <img :src="currentUser.avatar" class="img img-circle img-profile"/>
          {{ currentUser.name }}
          <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="javascript:;">Action</a></li>
          <li><a href="javascript:;">Another action</a></li>
          <li><a href="javascript:;">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="javascript:;">Separated link</a></li>
          <li class="divider"></li>
          <li><a href="javascript:;">One more separated link</a></li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data () {
    return {
      isDropdownUserOpen: false
    }
  },
  methods: {
    dropdownToggle () {
      this.isDropdownUserOpen = !this.isDropdownUserOpen
    }
  },
  computed: {
    ...mapGetters(['isLogged', 'currentUser'])
  }
}
</script>

<style lang="css">
  .img-profile {
    width: 20px;
    height: 20px;
  }
</style>
