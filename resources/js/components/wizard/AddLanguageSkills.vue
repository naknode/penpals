<template>
  <div class="hello">
    <h3>I know these languages:</h3>
    <div v-for="(k, i) in knows" v-bind:key="i">
      <div class="language">
        <select
          v-model="knows[i].language"
          class="el form-control"
          label="countryName">
          <option value="">Select Language</option>
          <option v-for="(language, i) in languages" v-bind:key="i" v-bind:value="language">
            {{ language }}
          </option>
        </select>
        <select
          v-model="knows[i].level"
          class="el form-control"
          placeholder="Fluency Level"
          label="countryName">
          <option v-for="(level, i) in levels" v-bind:key="i" v-bind:value="level">
            {{ level }}
          </option>
        </select>
        <div @click="addNew('knows')" class="el btn btn-secondary add">
          <lindua-icon icon="plus"></lindua-icon>
        </div>
        <div :disabled="i === 0" class="el btn btn-danger del" @click="remove(i, 'knows')">
          <lindua-icon icon="trash"></lindua-icon>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
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
      type: ['learning', 'knows'],
      knows: [{language: 'English', level: 'fluent'}],
      learning: [],
      levels: ['beginner', 'intermediate', 'advanced', 'fluent', 'native'],
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
  max-width: 50px;
  font-weight: bold;
  flex: 1;

  &.add {
    margin-right: 5px;
  }
}
</style>
