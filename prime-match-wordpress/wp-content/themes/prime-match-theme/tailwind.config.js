module.exports = {
  content: [
    './*.php',
    './template-parts/**/*.php',
    './inc/**/*.php'
  ],
  theme: {
    extend: {
      colors: {
        'lux-black': '#050505',
        'lux-ice': '#F5F5F5',
        'lux-gold': '#E1B965',
        'lux-graphite': '#1F1F1F'
      },
      fontFamily: {
        sans: ['Poppins', 'Inter', 'system-ui']
      }
    }
  },
  plugins: []
};
