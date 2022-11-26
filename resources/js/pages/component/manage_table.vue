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

<tr v-for="(datum,index) in data" :key="datum.id">
    <td>{{index+1}}</td>
<td >{{datum.name}}</td>
<td >{{datum.bn_name}}</td>

<td class="capital">{{datum.url}}</td>
<td>




 <router-link class="btn btn-app bg-secondary mr-1" :to="'/manage/district/'+datum.id"><i class="far fa-eye"></i>Districts
    <span class="badge bg-info">{{datum.hasDistrict}}</span>
 </router-link>
 <button class="btn btn-app bg-warning mr-1" @click="emit('editProp', datum)"><i class="far fa-edit"></i>
</button>
    <button class="btn btn-app bg-danger" v-show="!datum.hasDistrict" @click="emit('deleteProp', datum.id)"><i class="fas fa-trash"></i></button>
</td>

</tr>











</tbody>
</table>

</div>

    </div>

</template>

<script setup>
import {onMounted,defineProps,defineEmits} from 'vue'
const props = defineProps(['names','fields','data','edit']
    )
const emit = defineEmits(['editProp','deleteProp'])
    /* function editData(id) {


emit('editProp',{name:'hi'})
       console.log('emited')
    } */
   /*  const newName = computed(() =>  props.name) */
 onMounted(()=>{
    console.log(props.name);
})
</script>
