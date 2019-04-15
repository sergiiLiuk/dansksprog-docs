<template>
    <div>
        <h2 class="font-normal text-3xl text-gray-darkest leading-none mb-4">
            Docs Base
        </h2>
        <form @submit.prevent="addDocument">
            <div class="mb-4">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none 
                focus:shadow-outline" type="text" placeholder="Title" v-model="document.title">
            </div>
            <div class="mb-4">
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none 
                focus:shadow-outline" type="text" placeholder="Your Text" v-model="document.document"></textarea>
            </div>
            <button type="submit" class="bg-white hover:bg-blue-light text-grey-darkest font-semibold py-2 px-4 border border-grey-light rounded shadow">
            Submit
            </button>
        </form>
        <ul v-if="pagination" class="flex justify-center bg-gray-200 list-reset my-8">
            <li v-bind:class="[{disabled:!pagination.prev_page_url}]">
                <a class="border border-grey-dark text-grey-darker hover:bg-grey-light text-center px-4 py-2 rounded-l" href="#"
                @click="fetchDocuments(pagination.prev_page_url)">Previous</a>
            </li>    
                
            <li>
                <a class="border border-grey-dark text-grey-darker py-2 px-4" href="#">
                Page {{ pagination.current_page }} of {{pagination.last_page}}</a>
            </li>

            <li v-bind:class="[{disabled:!pagination.next_page_url}]">
                <a class="border border-grey-dark text-grey-darker hover:bg-grey-light text-center px-4 py-2 rounded-r" href="#" 
                @click="fetchDocuments(pagination.next_page_url)">Next</a>
            </li>               
        </ul>

        <div v-for="document in documents" v-bind:key="document.id" class="m-5 py-4 px-2 rounded border border-grey-dark">
            <h3><a class="text-l leading-tight text-grey-darkest" href="#">doc: {{ document.title }}</a></h3> 
            <!--small class="text-sm leading-tight text-grey-darker">Created on {{ date }} by {{ author }}</small-->  
            <hr>
            <button @click="editDocument(document)" class="bg-white hover:bg-yellow-light text-grey-darkest font-semibold py-2 px-4 border border-grey-light rounded shadow">
            Edit
            </button>
            <button @click="deleteDocument(document.id)" class="bg-white hover:bg-red-light text-grey-darkest font-semibold py-2 px-4 border border-grey-light rounded shadow">
            Delete
            </button>          
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                    documents: [],
                    document:{
                    id: '',
                    title: ''
                    },
                    document_id: '',
                    pagination: {},
                    edit: false
            }
         },
         created(){
             this.fetchDocuments();
         },

         methods:{
             fetchDocuments(page_url){
                 let vm = this;
                 page_url = page_url || '/api/documents'
                 fetch(page_url)
                 .then(res => res.json())
                 .then(res => {
                     this.documents = res.data;
                     vm.makePagination(res.meta, res.links);
                     //console.log(res.data)
                 })
                 .catch(err=>console.log(err));
             },

             makePagination(meta, links){
                  let pagination = {
                     current_page: meta.current_page,
                     last_page: meta.last_page,
                     next_page_url: links.next,
                     prev_page_url: links.prev
                 }
                 this.pagination = pagination;                 
             },
             deleteDocument(id){
                 if(confirm('Are You Sure?')){
                     fetch(`api/document/${id}`, {
                         method: 'delete'
                     })
                     .then(res => res.json())
                     .then(data => {
                         alert('Document Removed');
                         this.fetchDocuments();
                     })
                     .catch(err => console.log(err))
                 }
             },
             addDocument(){
                 if(this.edit === false ){
                     // Add
                     fetch('api/document', {
                         method: 'post',
                         body: JSON.stringify(this.document),
                         headers: {
                             'content-type': 'application/json'
                         }
                     })
                     .then(res => res.json())
                     .then(data => {
                         this.document.title = '';
                         this.document.document = '';
                         alert('Document Added');
                         this.fetchDocuments();
                     })
                     .catch(err => console.log(err))
                 }else{
                     // Update
                      fetch('api/document', {
                         method: 'put',
                         body: JSON.stringify(this.document),
                         headers: {
                             'content-type': 'application/json'
                         }
                     })
                     .then(res => res.json())
                     .then(data => {
                         this.document.title = '';
                         this.document.document = '';
                         alert('Document Updated');
                         this.fetchDocuments();
                     })
                     .catch(err => console.log(err))

                 }
             },
             editDocument(document){
                 this.edit = true;
                 this.document.id = document.id;
                 this.document.document_id = document.document_id;
                 this.document.title = document.title;
                 this.document.document = document.document;
             }
         }
     };
</script>