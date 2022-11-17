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
    



 <button class="btn btn-info mr-1" @click="emit('editProp', 1)"><i class="far fa-edit"></i></button>
    <button class="btn btn-danger" @click="deleteData(datum.id)"><i class="fas fa-trash"></i></button>
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
const emit = defineEmits(['editProp'])
    function editData(id) {
       /*  emit('edit',id); */
       
    emit('editProp',{name:'hi'})
       console.log('emited')
    }
   /*  const newName = computed(() =>  props.name) */
 onMounted(()=>{
    console.log(props.name);
}) 
</script>