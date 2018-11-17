<template>
  <div class="hello">
    <h3 class="mb-2 title">I {{ type === 'learning' ? 'am learning' : 'know' }} these languages:</h3>
    <div v-for="(k, i) in data[type]" v-bind:key="i">
      <div class="language mb-2">
        <select
          v-model="data[type][i].language_name"
          :name="`${type}_language[${i}]`"
          class="mr-2"
          label="countryName">
          <option value="">Select Language</option>
          <option v-for="(language, i) in languages" v-bind:key="i" v-bind:value="language">
            {{ language }}
          </option>
        </select>
        <select
          v-model="data[type][i].fluency"
          :name="`${type}_fluency[${i}]`"
          class="mr-2"
          v-on:change="updateLang(data[type][i], i)"
          placeholder="Fluency Level"
          label="countryName">
          <option v-for="(fluency, i) in levels[type]" v-bind:key="i" v-bind:value="fluency">
            {{ fluency }}
          </option>
        </select>
        <button @click.prevent="addNew(type)" class="btn btn-secondary add">
          ADD
        </button>
        <button :disabled="i === 0" class="btn btn-danger del" @click.prevent="remove(i, type)">
          DEL
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['type'],
  created() {
    axios.get(route('languages.user.get', { user: window.App.user.username, type: this.type}))
      .then(e => {
        const data = e.data.map(d => {
          return {
            id: d.id,
            language_name: d.language_name,
            fluency: d.fluency
          }
        });

        if (data.length) {
          this.data[this.type] = data;
        }
      });
  },
  methods: {
    /**
     * Update the language
     *
     * @param {object} data The object of the language
     * @param {integer} index The index in their place
     */
    updateLang(data, index) {
      const { language_name, fluency, id } = data;

      if (id) {
        axios.post('/language/ ' + id + '/update', {
          language_name,
          fluency,
          type: this.type,
          id,
          user_id: window.App.user.id
        })
        .then(e => {
          if (e.status === 200) {
            this.$awn.success('Successfully updated.')
          }
        })
        .catch(error => {
          if (error.response.status === 403) {
            this.$awn.alert(error.response.data.message)
          }
        });
      } else {
        if (fluency !== "" && language_name !== "") {
          axios.post('/language/add', {
            language_name,
            fluency,
            type: this.type,
            user_id: window.App.user.id
          })
          .then(e => {
            if (e.status === 200) {
              this.data[this.type][index] = { ...this.data[this.type][index], id: e.data};
            }
          })
          .catch(error => {
            if (error.response.status === 403) {
              this.$awn.alert(error.response.data.message)
            }
          });
        }
      }
    },
    /**
     * Add a new language block
     *
     * @param {string} type The type of language
     */
    addNew(type) {
      const block = {
        language_name: '',
        fluency: ''
      };

      this.data[this.type].push(block);
    },
    /**
     * Delete the language
     *
     * @param {integer} id The ID of the language resource
     * @returns {promise}
     */
    deleteLanguage(id) {
      return new Promise(resolve => {
        axios.delete('/language/' + id + '/destroy', {
          id,
        })
        .then(e => {
          if (e.status === 200) {
            resolve(id);
          }
        })
        .catch(error => {
          if (error.response.status === 403) {
            this.$awn.alert(error.response.data.message);
          }
        });
      })
    },
    /**
     * Remove the language from the list
     *
     * @param {integer} index The index item in the list
     * @param {string} type The type of language
     */
    async remove(index, type) {
      if (index === 0) return;

      if (this.data[this.type][index].id) {
        await this.deleteLanguage(this.data[this.type][index].id)
      }

      this.data[this.type].splice(index, 1);
    },
  },
  data() {
    return {
      languageType: this.type,
      data: {
        speaks: [{language_name: '', fluency: ''}],
        learning: [{language_name: '', fluency: ''}],
      },
      levels: {
        'speaks': ['beginner', 'intermediate', 'advanced', 'fluent', 'native'],
        'learning': ['beginner', 'conversational', 'working fluency', 'professional fluency', 'fluent'],
      },
      languages: [
        'Afrikanns',
        'Albanian',
        'Arabic',
        'Armenian',
        'Basque',
        'Bengali',
        'Bulgarian',
        'Catalan',
        'Cambodian',
        'Chinese',
        'Croation',
        'Czech',
        'Danish',
        'Dutch',
        'English',
        'Estonian',
        'Fiji',
        'Finnish',
        'French',
        'Georgian',
        'German',
        'Greek',
        'Gujarati',
        'Hebrew',
        'Hindi',
        'Hungarian',
        'Icelandic',
        'Indonesian',
        'Irish',
        'Italian',
        'Japanese',
        'Javanese',
        'Korean',
        'Latin',
        'Latvian',
        'Lithuanian',
        'Macedonian',
        'Malay',
        'Malayalam',
        'Maltese',
        'Maori',
        'Marathi',
        'Mongolian',
        'Nepali',
        'Norwegian',
        'Persian',
        'Polish',
        'Portuguese',
        'Punjabi',
        'Quechua',
        'Romanian',
        'Russian',
        'Samoan',
        'Serbian',
        'Slovak',
        'Slovenian',
        'Spanish',
        'Swahili',
        'Swedish',
        'Tamil',
        'Tatar',
        'Telugu',
        'Thai',
        'Tibetan',
        'Tonga',
        'Turkish',
        'Ukranian',
        'Urdu',
        'Uzbek',
        'Vietnamese',
        'Welsh',
        'Xhosa',
      ]
    };
  }
};
</script>

<style lang="scss" scoped>

.hello {
  text-align: left;
}
.language {
  display: flex;
}
.v-select {
  margin-right: 1em !important;
  flex: 3;
}
button {
  font-weight: bold;
  flex: 1;

  &.add {
    margin-right: 5px;
  }
}
</style>
