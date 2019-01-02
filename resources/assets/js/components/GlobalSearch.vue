<template>
    <div class="search-box">
        <input type="text" :placeholder='searchPlaceholder' class="suggestion" v-model="input" @keyup="openSuggestions" name="keyword" v-on:blur="blurFunction(false)"  v-on:focus="blurFunction(true)" autocomplete="off" />
        <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
        <div class="suggestion-list" v-bind:class="{ active: showSuggestion }">
            <ul class="suggestion">
                <li v-for="(suggestion, idx) in suggestions">
                    <template v-if="idx == 'product'">
                        Program
                    </template>
                    <template v-else-if="idx == 'category'">
                        Kategori
                    </template>
                    <template v-else-if="idx == 'category_classification'">
                        Klasifikasi Kategori
                    </template>
                    <template v-else-if="idx == 'industry'">
                        Industri
                    </template>
                    <template v-else-if="idx == 'profession'">
                        Profesi
                    </template>
                    <ul class="product-suggestion">
                        <li v-for="list in suggestion">
                            <a :href="list.url">
                                <i v-if="idx == 'product'" class="fa fa-book" ></i>
                                <i v-else-if="idx == 'category'" class="fa fa-tag"></i>
                                <i v-else-if="idx == 'category_classification'" class="fa fa-graduation-cap"></i>
                                <i v-else-if="idx == 'industry'" class="fa fa-user" ></i>
                                <i v-else-if="idx == 'profession'"  class="fa fa-suitcase"></i>
                                {{ list.name }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            searchPlaceholder: {
                type: String,
                default: 'Coba ketik "Data Science"'
            }
        },
        data() {

            return {
                input: '',
                suggestions: {},
                showSuggestion: false
            }
        },
        methods: {
            openSuggestions() {
                const that = this;

                axios.get('/api/suggestion', {
                    params: {
                        keyword: this.input
                    }
                }).then(function (response) {
                    let resData = response.data

                    that.suggestions = {}

                    if (resData.product.length > 0) {
                        that.suggestions = response.data

                        that.showSuggestion = true
                    }
                    
                }).catch(function (error) {
                    that.showSuggestion = false
                });
            },
            blurFunction(val) {
                const that = this

                if (val) {
                    if (that.input.length == 0) {
                        return that.showSuggestion = false
                    } else {
                        return that.showSuggestion = val
                    }
                }

                setTimeout(function() {
                    that.showSuggestion = val
                }, 250)
            }
        }
    }
</script>
