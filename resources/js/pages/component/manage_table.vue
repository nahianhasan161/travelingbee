<template>
    <div>
        <!-- <p v-for="field in fields">
            {{field}}
        </p> -->

        <div class="card-body table-responsive">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th v-for="(name,index) in names" :key="index">{{name}}</th>



</tr>
</thead>
<tbody>
{{data.value}}
<tr v-for="(datum,index) in data" :key="datum.id">
    <td>{{index+1}}</td>
<td >{{datum.name}}</td>
<td >{{datum.bn_name}}</td>

<td class="capital">{{datum.url}}</td>
<td>




 <router-link  class="btn btn-app bg-secondary mr-1" v-show="buttons ? buttons[0] : false"
 :to="(buttonLinks ? buttonLinks[0] : '') + datum.id"><i class="far fa-eye"></i>{{(buttons ? buttons[0] : '') }}
    <span class="badge bg-info">{{datum.subCount}}</span>
 </router-link>
 <button class="btn btn-app bg-warning mr-1" @click="emit('editProp', datum)">
    <i class="far fa-edit"></i>
</button>
    <button class="btn btn-app bg-danger"
    v-show="!datum.subCount" @click="emit('deleteProp', datum.id)">
        <i class="fas fa-trash"></i>
    </button>
</td>

</tr>











</tbody>
</table>

</div>

    </div>

</template>

<script setup>
import {onMounted,defineProps,defineEmits} from 'vue'
const props = defineProps(['names','fields','data','edit','buttons','buttonLinks']
    )
const emit = defineEmits(['editProp','deleteProp'])
    /* function editData(id) {


emit('editProp',{name:'hi'})
       console.log('emited')
    } */
   /*  const newName = computed(() =>  props.name) */
 onMounted(()=>{

})
</script>
