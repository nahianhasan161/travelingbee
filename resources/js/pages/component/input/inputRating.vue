<template>
    <div>

        <div class="form-group ">
      <label for="FormControlSelect " >Rating : </label>
      <i  class="fa  fa-star " :class="rating? (index <= rating ? 'star-rating' : '') : '' "
       v-for="index in 5"  :key="index" @click="inputRating(index)"
    ></i>
    {{rating}}
      <!-- <select v-model="review.rating" class="form-control" :class="reviewErrors.rating ? 'is-invalid' : '' " id="FormControlSelect"> -->

    <div class="text-danger" v-if="errors">
               <p v-for="error in errors">
                {{error}}
               </p>
             </div>
    </div>

    </div>

</template>

<script setup>

import {onMounted,defineProps,defineEmits,reactive,ref} from 'vue'
const props = defineProps(['rating','errors'])
const emit = defineEmits(['update:rating',"update:errors"])

function inputRating(rating){
            console.log(rating)
            /* rating = rating */
            /* review.rating = rating */
            emit('update:rating', rating)
          }


</script>
