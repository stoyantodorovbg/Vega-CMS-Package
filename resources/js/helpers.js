let helpers = {
    adminUrlPrefix (locale) {
        return '/admin/' + locale;
    },

    frontUrlPrefix (locale) {
        return '/' + locale;
    },

    processStyles(stylesData) {
        let styles = '';
        for (let prop in stylesData) {
            styles += prop + ': ' + stylesData[prop] + '; ';
        }
        return styles;
    }
};

export default helpers;
