import $ from 'jquery';

// $.terminal.ansi_colors.normal = $.terminal.ansi_colors.bold;

class OutputFormatterStyle {
    constructor(foreground = 'white', background = 'black', options = []) {
        Object.assign(this, {
            options,
            colorList: {
                30: 'black',
                31: 'red',
                32: 'green',
                33: 'yellow',
                34: 'blue',
                35: 'magenta',
                36: 'cyan',
                37: 'white',

                39: 'white',
            },

            backgroundList: {
                40: 'black',
                41: 'red',
                42: 'green',
                43: 'yellow',
                44: 'blue',
                45: 'magenta',
                46: 'cyan',
                47: 'white',

                49: 'black',
            },

            colors: Object.assign($.terminal.ansi_colors.bold, {
                white: $.terminal.ansi_colors.normal.white,
                red: $.terminal.ansi_colors.normal.red,
            }),
        });

        this.foreground = this.getColor(foreground);
        this.background = this.getColor(background);
    }

    getColor(color) {
        return this.colors[color] ? this.colors[color] : color;
    }

    apply(text) {
        return `[[;${this.foreground};${this.background}]${$.terminal.escape_brackets(text)}]`;
    }
}

export class OutputFormatter {
    constructor() {
        Object.assign(this, {
            formatters: {
                black: new OutputFormatterStyle('black'),
                red: new OutputFormatterStyle('red'),
                green: new OutputFormatterStyle('green'),
                yellow: new OutputFormatterStyle('yellow'),
                blue: new OutputFormatterStyle('blue'),
                magenta: new OutputFormatterStyle('magenta'),
                cyan: new OutputFormatterStyle('cyan'),
                white: new OutputFormatterStyle('white'),
                error: new OutputFormatterStyle('white', 'red'),
                info: new OutputFormatterStyle('green'),
                comment: new OutputFormatterStyle('yellow'),
                question: new OutputFormatterStyle('magenta'),
            },
        });
    }

    error(text) {
        return this.formatters.error.apply(text);
    }

    info(text) {
        return this.formatters.info.apply(text);
    }

    comment(text) {
        return this.formatters.comment.apply(text);
    }

    question(text) {
        return this.formatters.question.apply(text);
    }

    black(text) {
        return this.formatters.black.apply(text);
    }

    red(text) {
        return this.formatters.red.apply(text);
    }

    green(text) {
        return this.formatters.green.apply(text);
    }

    yellow(text) {
        return this.formatters.yellow.apply(text);
    }

    blue(text) {
        return this.formatters.blue.apply(text);
    }

    magenta(text) {
        return this.formatters.magenta.apply(text);
    }

    cyan(text) {
        return this.formatters.cyan.apply(text);
    }

    white(text) {
        return this.formatters.white.apply(text);
    }
}

export default new OutputFormatter();
