<template>
    <div>
        <h1 class="font-normal text-3xl text-gray-darkest leading-none mb-4">
            Docs Base
        </h1>
        <div class="rounded-lg shadow p-3">
            <h3><a class="text-l leading-tight text-grey-darkest" href="#">doc: {{ title }}</a></h3> 
            <small class="text-sm leading-tight text-grey-darker">Created on {{ date }} by {{ author }}</small>               
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                    title: 'Mit job',
                    date: '10-08-2019',
                    author: 'Sergii Liuk'
            }
         }
     };
</script>