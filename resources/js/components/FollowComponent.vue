<template>
  <!--<button type="button" @click="click"></button>-->
    <div class="float-right">
      <h5><a :href="'/users/'+userId+'/follower'" style="margin-right: 20px;
        margin-bottom: 10px;
        position: relative;
        display: inline-block;
        font-weight: bold;
        padding: 0.25em 0.5em;
        text-decoration: none;
        color: #00BCD4;
        background: #ECECEC;
        border-radius: 0 15px 15px 0;
        transition: .4s;
        " onMouseOut="this.style.background='#ECECEC'" onMouseOver="this.style.background='#636363'">{{ followCount }}フォロワー</a></h5>
      <button v-if="!followed" type="button" class="btn-sm shadow-none border border-primary p-2" @click="follow(userId)">
        <i class="mr-1 fas fa-user-plus"></i>フォロー</button>
      <button  v-else type="button" class="btn-sm shadow-none border border-primary p-2 bg-primary text-white" @click="unfollow(userId)">
        <i class="mr-1 fas fa-user-check"></i>フォロー中</button>
    </div>
</template>
    

<script>
//const axios = require('axios');

    export default {
        props:['userId', 'defaultFollowed', 'defaultCount'],
        data() {
          return{
              followed: false,
              followCount: 0,
          };
        },
        created() {
          this.followed = this.defaultFollowed
          this.followCount = this.defaultCount
        },

        methods: {
          follow(userId) {
            let url = `/users/${userId}/follow`

            axios.post(url)
            .then(response => {
                this.followed = true;
                this.followCount = response.data.followCount;
            })
            .catch(error => {
              alert(error)
            });
          },
          unfollow(userId) {
            let url = `/users/${userId}/unfollow`

            axios.post(url)
            .then(response => {
                this.followed = false;
                this.followCount = response.data.followCount;
            })
            .catch(error => {
              alert(error)
            });
          }
        }
    }
</script>
