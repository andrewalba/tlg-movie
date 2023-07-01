<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actors') }}
        </h2>
    </x-slot>

    <div class="pt-2 pb-12" x-data="actorsData">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-8 grid grid-cols-2">
                <div></div>
                <div class="place-self-end">
                    <button @click="$dispatch('edit', 0);" class="bg-blue-700 rounded text-white w-36 p-2"><span><x-icon-add class="inline-block" /> New Actor</span></button>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table id="actorsTable">
                        <thead>
                        <tr>
                            <th colspan="2"></th>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>Alternative Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-if="!actors">
                            <tr><td colspan="3"><i>Loading...</i></td></tr>
                        </template>
                        <template x-for="_actor in actors">
                            <tr :id=`actor-${_actor.id}`>
                                <td>
                                    <a @click="$dispatch('edit', _actor.id);" title="edit"><x-icon-edit class="w-10 h-10 fill-current text-gray-500" /></a>
                                </td>
                                <td>
                                    <a @click="deleteActor(_actor.id);" title="delete"><x-icon-delete class="w-10 h-10 fill-current text-gray-500" /></a>
                                </td>
                                <td x-text="_actor.name"></td>
                                <td x-text="_actor.rating"></td>
                                <td x-text="_actor.alternative_name"></td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                    <div class="my-8">
                        <button class="border border-gray-300 rounded p-2" @click="init(`${links.first}`)"><x-icon-first /></button>
                        <button class="border border-gray-300 rounded p-2" @click="init(`${links.prev}`)"><x-icon-previous /></button>
                        <button class="border border-gray-300 rounded p-2" @click="init(`${links.next}`)"><x-icon-next /></button>
                        <button class="border border-gray-300 rounded p-2" @click="init(`${links.last}`)"><x-icon-last /></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="dialog">
        <div x-data="actorData">
            <div x-show="showModal" @edit.window="loadActor($event.detail);" id="defaultModal" tabindex="-1" x-bind:aria-hidden="showModal" class="fixed top-0 left-0 right-0 z-50 mx-auto mt-8 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full" style="width: 50%;">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Actor
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal" @click="showModal = false">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <template x-if="!actor">
                                <i>Loading...</i>
                            </template>
                            <template x-if="actor">
                                <div class="mt-8 max-w-md">
                                    <div class="grid grid-cols-1 gap-6">
                                        <form id="actorForm" @submit.prevent="submitForm">
                                            <input type="hidden"
                                                   name="id"
                                                   x-model="formData.id"
                                                   :value="actor.id"/>
                                            <label class="block">
                                                <span class="text-gray-700">Actor name</span>
                                                <input type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                       placeholder="Full Name"
                                                       name="name"
                                                       x-model="formData.name"
                                                       :value="actor.name">
                                            </label>

                                            <label class="block">
                                                <span class="text-gray-700">Rating</span>
                                                <input type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                       name="rating"
                                                       placeholder="IMDB Actor Rating"
                                                       x-model="formData.rating"
                                                       :value="actor.rating">
                                            </label>

                                            <label class="block">
                                                <span class="text-gray-700">Actor Alternative Name</span>
                                                <input type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                       placeholder="Also Known As"
                                                       name="alternative_name"
                                                       x-model="formData.alternative_name"
                                                       :value="actor.alternative_name">
                                            </label>
                                        </form>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="defaultModal" type="button" @click="submitForm" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" x-text="formData.id > 0 ? 'Edit' : 'Add'"></button>
                            <button data-modal-hide="defaultModal" type="reset" @click="resetForm" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <style>
        td, th {
            padding: 5px;
        }
    </style>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('actorsData', () => ({
                modelOpen: false,
                response: null,
                actors: null,
                actor: null,
                links: {
                    first: null,
                    last: null,
                    prev: null,
                    next: null,
                },
                async init(url = 'http://localhost/api/actors') {
                    let resp = await fetch(url);
                    this.response = await resp.json();
                    this.actors = this.response.data;
                    this.links = this.response.links;
                },
                async deleteActor(id) {
                    const resp = await fetch(`http://localhost/api/actors/${id}`, {
                        method: 'DELETE',
                        headers: {
                            "Content-Type": "application/json",
                        },
                    });
                    console.log(`resp:`, resp);
                    const response = await resp.json();
                    document.getElementById(`actor-${id}`).remove();
                },
            }));

            Alpine.data('actorData', () => ({
                showModal: false,
                actor: null,
                formData: {
                    id: 0,
                    name: null,
                    rating: null,
                    alternative_name: null,
                },
                async loadActor(id) {
                    if (id) {
                        let resp = await fetch(`http://localhost/api/actors/${id}`);
                        const response = await resp.json();
                        this.actor = response.data;
                    }

                    if (this.actor) {
                        this.formData = this.actor;
                    } else {
                        this.actor = this.formData;
                    }
                    this.showModal = true;
                },
                resetForm() {
                    document.getElementById('actorForm').reset();
                    document.getElementsByName("id")[0].value = 0;
                    this.showModal = false;
                },
                async submitForm() {
                    if (this.formData.id > 0) {
                        const resp = await fetch(`http://localhost/api/actors/${this.formData.id}`, {
                            method: 'PUT',
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify(this.formData),
                        });
                        this.actor = await resp.json();

                        const row = document.getElementById(`actor-${this.formData.id}`).getElementsByTagName('td');
                        row[2].innerHTML = this.formData.name;
                        row[3].innerHTML = this.formData.rating;
                        row[4].innerHTML = this.formData.alternative_name;
                    } else {
                        const resp = await fetch(`http://localhost/api/actors`, {
                            method: 'POST',
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify(this.formData),
                        });
                        this.actor = await resp.json();
                    }

                    this.resetForm();
                },
            }));
        });
    </script>
</x-app-layout>
