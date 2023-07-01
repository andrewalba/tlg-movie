<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movies') }}
        </h2>
    </x-slot>

    <div class="pt-2 pb-12" x-data="moviesData">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-8 grid grid-cols-2">
                <div></div>
                <div class="place-self-end">
                    <button @click="$dispatch('edit', 0);" class="bg-blue-700 rounded text-white w-36 p-2"><span><x-icon-add class="inline-block" /> New Movie</span></button>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table id="moviesTable">
                        <thead>
                        <tr>
                            <th colspan="2"></th>
                            <th>Title</th>
                            <th>Year</th>
                            <th>Score</th>
                            <th>Rating</th>
                            <th>Genres</th>
                            <th>Image</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-if="!movies">
                            <tr><td colspan="6"><i>Loading...</i></td></tr>
                        </template>
                        <template x-for="_movie in movies">
                            <tr :id=`movie-${_movie.id}`>
                                <td>
                                    <a @click="$dispatch('edit', _movie.id);" title="edit">
                                        <x-icon-edit class="w-10 h-10 fill-current text-gray-500" />
                                    </a>
                                </td>
                                <td>
                                    <a @click="deleteMovie(_movie.id);" title="delete">
                                        <x-icon-delete class="w-10 h-10 fill-current text-gray-500" />
                                    </a>
                                </td>
                                <td x-text="_movie.title"></td>
                                <td x-text="_movie.year"></td>
                                <td x-text="_movie.score"></td>
                                <td x-text="_movie.rating"></td>
                                <td x-text="_movie.genres"></td>
                                <td>
                                    <img :src="_movie.image" :alt="_movie.title"/>
                                </td>
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
        <div x-data="movieData">
            <div x-show="showModal" @edit.window="loadMovie($event.detail);" id="defaultModal" tabindex="-1" :aria-hidden="showModal" class="fixed top-0 left-0 right-0 z-50 mx-auto mt-8 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full" style="width: 50%;">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Movie
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal" @click="resetForm">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <template x-if="!movie">
                                <i>Loading...</i>
                            </template>
                            <template x-if="movie">
                                <div class="mt-8 max-w-md">
                                    <div class="grid grid-cols-1 gap-6">
                                        <form id="movieForm" @submit.prevent="submitForm">
                                            <input type="hidden"
                                                   name="id"
                                                   x-model="formData.id"
                                                   :value="movie.id"/>
                                            <label class="block">
                                                <span class="text-gray-700">Movie title</span>
                                                <input type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                       placeholder="Title"
                                                       name="title"
                                                       x-model="formData.title"
                                                       :value="movie.title">
                                            </label>

                                            <label class="block">
                                                <span class="text-gray-700">Year</span>
                                                <input type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                       placeholder="Year of release"
                                                       name="year"
                                                       x-model="formData.year"
                                                       :value="movie.year">
                                            </label>

                                            <label class="block">
                                                <span class="text-gray-700">Score</span>
                                                <input type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                       placeholder="Movie score"
                                                       name="score"
                                                       x-model="formData.score"
                                                       :value="movie.score">
                                            </label>

                                            <label class="block">
                                                <span class="text-gray-700">Rating</span>
                                                <input type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                       placeholder="Movie rating"
                                                       name="rating"
                                                       x-model="formData.rating"
                                                       :value="movie.rating">
                                            </label>

                                            <label class="block">
                                                <span class="text-gray-700">Image</span>
                                                <input type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                       placeholder="URL to image"
                                                       name="image"
                                                       x-model="formData.image"
                                                       :value="movie.image">
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
            Alpine.data('moviesData', () => ({
                modelOpen: false,
                response: null,
                movies: null,
                movie: null,
                links: {
                    first: null,
                    last: null,
                    prev: null,
                    next: null,
                },
                async init(url = 'http://localhost/api/movies') {
                    let resp = await fetch(url);
                    this.response = await resp.json();
                    this.movies = this.response.data;
                    this.links = this.response.links;
                },
                async deleteMovie(id) {
                    const resp = await fetch(`http://localhost/api/movies/${id}`, {
                        method: 'DELETE',
                        headers: {
                            "Content-Type": "application/json",
                        },
                    });
                    console.log(`resp:`, resp);
                    const response = await resp.json();
                    console.log(`response: `, response);
                    document.getElementById(`movie-${id}`).remove();
                },
            }));

            Alpine.data('movieData', () => ({
                showModal: false,
                movie: null,
                formData: {
                    id: 0,
                    title: null,
                    year: null,
                    score: null,
                    rating: null,
                    image: null,
                },
                async loadMovie(id = 0) {
                    if (id) {
                        let resp = await fetch(`http://localhost/api/movies/${id}`);
                        const response = await resp.json();
                        this.movie = response.data;
                    }

                    if (this.movie) {
                        this.formData = this.movie;
                    } else {
                        this.movie = this.formData;
                    }
                    this.showModal = true;
                },
                resetForm() {
                    document.getElementById('movieForm').reset();
                    document.getElementsByName("id")[0].value = 0;
                    this.showModal = false;
                },
                async submitForm() {
                    if (this.formData.id > 0) {
                        const resp = await fetch(`http://localhost/api/movies/${this.formData.id}`, {
                            method: 'PUT',
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify(this.formData),
                        });
                        this.movie = await resp.json();

                        // const new_movie = this.movies.find(movie => movie.id === this.formData.id);

                        const row = document.getElementById(`movie-${this.formData.id}`).getElementsByTagName('td');
                        row[2].innerHTML = this.formData.title;
                        row[3].innerHTML = this.formData.year;
                        row[4].innerHTML = this.formData.score;
                        row[5].innerHTML = this.formData.rating;
                        const img = row[7].getElementsByTagName('img')[0];
                        img.src = this.formData.image;

                    } else {
                        const resp = await fetch(`http://localhost/api/movies`, {
                            method: 'POST',
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify(this.formData),
                        });
                        this.movie = await resp.json();

                        // this.movies.push(this.movie);
                    }

                    this.resetForm();
                },
            }));
        });
    </script>
</x-app-layout>
