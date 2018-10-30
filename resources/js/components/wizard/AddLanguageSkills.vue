<template>
  <div class="hello">
    <h3 class="mb-2 title">I {{ type === 'learning' ? 'am learning' : 'know' }} these languages:</h3>
    <div v-for="(k, i) in knows" v-bind:key="i">
      <div class="language mb-2">
        <select
          v-model="knows[i].language"
          :name="`${type}_language[${i}]`"
          class="el form-control mr-2"
          label="countryName">
          <option value="">Select Language</option>
          <option v-for="(language, i) in languages" v-bind:key="i" v-bind:value="language">
            {{ language }}
          </option>
        </select>
        <select
          v-model="knows[i].level"
          :name="`${type}_fluency[${i}]`"
          class="el form-control mr-2"
          placeholder="Fluency Level"
          label="countryName">
          <option v-for="(level, i) in levels[type]" v-bind:key="i" v-bind:value="level">
            {{ level }}
          </option>
        </select>
        <button @click.prevent="addNew('knows')" class="el btn btn-secondary add">
          ADD
        </button>
        <button :disabled="i === 0" class="el btn btn-danger del" @click.prevent="remove(i, 'knows')">
          DEL
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['type'],
  methods: {
    addNew(type) {
      const block = {
        language: '',
        level: ''
      };
      if (type === 'knows') {
        this.knows.push(block);
      } else {
        this.learning.push(block);
      }
    },
    remove(index, type) {
      if (index === 0) return;

      if (type === 'knows') {
        this.knows.splice(index, 1);
      } else {
        this.learning.splice(index, 1);
      }
    },
  },
  data() {
    return {
      languageType: this.type,
      knows: [{language: 'English', level: ''}],
      learning: [],
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
