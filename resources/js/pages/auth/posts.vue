<template>


    <div class="container-fluid">

<div class="text-center" v-if="loading">
    <div class="spiner-border position-absolute" role="status" >
        <span class="sr-only">Loading....</span>
    </div>
</div>


        <h1 class="text-center">Posts</h1>
        <div class="row" >
            <div class="col-md-8 p-4" >
                <div class="row">
                    <div class="col-md-6 mt-1" v-for="post in posts " :key="post.id">
                        <div class="card" style="width: 18rem;">
                            {{post.image}}
  <img :src="'image/'+post.image" class="card-img-top" alt="..." v-if="post.image">
  <div class="card-body">
    <h5 class="card-title">{{post.title}}</h5>
    <p class="card-text">{{post.description}}</p>
    <div class="d-flex justify-content-between">
            <button class="btn btn-primary" @click="editItem(post.id)">
                Edit
            </button>

            <button class="btn btn-danger" @click="deleteItem(post.id)">Delete</button>
        </div>
  </div>
</div>

                    </div>

                </div>

        </div>
            <div class="col-4">
                <div class="card" style="width: 18rem;">

  <div class="card-body">
    <h5 class="card-title">Create Post</h5>
    <form  method="Post" @submit.prevent="addItem">
    <input type="text" class="form-control mt-5" v-model="title">
    <textarea class="form-control mt-5" name="descroption" id="descroption" cols="30" rows="10" v-model="description"></textarea>
        <input type="file" class="form-control mt-5" @change="imageUpload($event)"> <!-- v-model="image" -->
            <button class="btn btn-primary">
                {{editId ? 'Update' : 'Post'}}
            </button>
        </form>
  </div>
</div>
        </div>
        </div>
    </div>

</template>
<script setup>
    import { storeToRefs } from 'pinia';
    import {PostStore} from '@/store/post/PostStore'

    const { posts,title,description,editId,loading} = storeToRefs(PostStore())
    const {addItem,fetchPosts,deleteItem,editItem,imageUpload} = PostStore();
    fetchPosts();
</script>
<style>
    html,
body {
  width: 100%;
  height: 100%;
}
.container-bee {
  position: relative;
  display: flex;
  background: #ffeb3b;
  width: 100%;
  height: 100%;
  top: 100px;
  overflow: hidden;
}
.bee {
  position: relative;
  margin: auto;
  align-self: center;
  width: 50px;
  height: 50px;
  -webkit-animation: to-fly 0.4s infinite;
          animation: to-fly 0.4s infinite;
}
.body {
  position: relative;
  width: 40px;
  height: 18px;
  border: 4px solid #fbc02d;
  background: #ffeb3b;
  border-radius: 20px;
  perspective: 2500px;
  z-index: 99;
}
.body:before,
.body:after {
  content: '';
  position: absolute;
  width: 0;
  height: 0;
}
.body:before {
  right: 100%;
  top: 3px;
  border-top: 6px solid transparent;
  border-right: 13px solid #fbc02d;
  border-bottom: 6px solid transparent;
}
.body:after {
  right: 97%;
  top: 6px;
  border-top: 3px solid transparent;
  border-right: 6px solid #ffeb3b;
  border-bottom: 3px solid transparent;
}
.body .line {
  position: relative;
  left: 10px;
  height: 18px;
  width: 18px;
  background: #fbc02d;
}
.wing-right,
.wing-left {
  position: absolute;
  top: -18px;
  left: 12px;
  width: 15px;
  height: 15px;
  background: #ffeb3b;
  border: 4px solid #fbc02d;
  border-radius: 100%;
}
.wing-right {
  left: 15px;
  transform: skew(-20deg);
  -webkit-animation: wing-beat-right 0.25s infinite;
          animation: wing-beat-right 0.25s infinite;
  transform-origin: bottom;
  z-index: 9;
}
.wing-left {
  transform: skew(20deg);
  -webkit-animation: wing-beat-left 0.25s infinite;
          animation: wing-beat-left 0.25s infinite;
  transform-origin: bottom;
  z-index: 999;
}
.path {
  display: inline-block;
  position: relative;
  top: -24px;
  left: -90px;
  width: 140px;
  -webkit-animation: pollen 0.14s infinite;
          animation: pollen 0.14s infinite;
}
.pollen {
  display: inline-block;
  margin: 0;
  width: 3px;
  height: 3px;
  background: #fbc02d;
  border-radius: 100%;
}
@-webkit-keyframes to-fly {
  50% {
    transform: translateY(-3px);
  }
  100% {
    transform: translateY(0px);
  }
}
@keyframes to-fly {
  50% {
    transform: translateY(-3px);
  }
  100% {
    transform: translateY(0px);
  }
}
@-webkit-keyframes wing-beat-right {
  50% {
    transform: rotateX(60deg) skew(-20deg) rotateZ(25deg);
  }
  100% {
    transform: rotateX(0) skew(-20deg);
  }
}
@keyframes wing-beat-right {
  50% {
    transform: rotateX(60deg) skew(-20deg) rotateZ(25deg);
  }
  100% {
    transform: rotateX(0) skew(-20deg);
  }
}
@-webkit-keyframes wing-beat-left {
  50% {
    transform: rotateX(-65deg) skew(20deg) rotateZ(-10deg);
  }
  100% {
    transform: rotateX(0) skew(20deg);
  }
}
@keyframes wing-beat-left {
  50% {
    transform: rotateX(-65deg) skew(20deg) rotateZ(-10deg);
  }
  100% {
    transform: rotateX(0) skew(20deg);
  }
}
@-webkit-keyframes pollen {
  0% {
    left: -90px;
  }
  100% {
    left: -95px;
  }
}
@keyframes pollen {
  0% {
    left: -90px;
  }
  100% {
    left: -95px;
  }
}

</style>




