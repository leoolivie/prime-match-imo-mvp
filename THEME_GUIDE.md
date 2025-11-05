# Modern Luxury Theme - Usage Guide

This document provides guidance on using the new Tailwind CSS luxury theme implemented in this project.

## Color Palette

### Luxury Colors
- `lux-black` - Deep black (HSL: 0 0% 8%)
- `lux-slate` - Dark slate (HSL: 220 15% 25%)
- `lux-graphite` - Medium graphite (HSL: 220 10% 45%)
- `lux-ice` - Light ice blue (HSL: 200 20% 95%)
- `lux-gold` - Vibrant gold (HSL: 43 96% 56%)

### Usage Examples
```html
<!-- Background colors -->
<div class="bg-lux-black">Dark background</div>
<div class="bg-lux-gold">Gold background</div>

<!-- Text colors -->
<p class="text-lux-gold">Gold text</p>
<p class="text-lux-ice">Light ice text</p>

<!-- Border colors -->
<div class="border-2 border-lux-gold">Gold border</div>
```

## Gradients

### Available Gradients
- `bg-lux-hero` - Hero section gradient (black to slate)
- `bg-lux-card` - Card gradient (white to ice)
- `bg-lux-gold` - Gold gradient

### Usage Examples
```html
<!-- Hero section with gradient -->
<div class="bg-lux-hero text-white py-20">
  <h1>Welcome to Prime Match</h1>
</div>

<!-- Card with gradient background -->
<div class="bg-lux-card p-6 rounded-lg">
  <h3>Feature Card</h3>
</div>
```

## Shadows

### Available Shadows
- `shadow-lux-card` - Elegant card shadow
- `shadow-lux-glow` - Gold glow effect

### Usage Examples
```html
<!-- Card with luxury shadow -->
<div class="bg-white p-6 rounded-lg shadow-lux-card">
  Content
</div>

<!-- Element with glow effect -->
<button class="bg-lux-gold shadow-lux-glow">
  Highlighted Button
</button>
```

## Animations

### Available Animations
- `animate-glow` - Pulsing glow effect (2s infinite)
- `animate-fade-in` - Fade in from bottom (0.6s)
- `animate-fade-in-up` - Fade in with upward motion (0.8s)
- `animate-scale-in` - Scale up animation (0.4s)
- `animate-slide-in-right` - Slide in from right (0.5s)
- `animate-accordion-down` - Accordion expand (0.3s)
- `animate-accordion-up` - Accordion collapse (0.3s)

### Usage Examples
```html
<!-- Button with glow animation -->
<button class="bg-lux-gold animate-glow">
  Attention Grabber
</button>

<!-- Card with fade in animation -->
<div class="bg-white p-6 animate-fade-in">
  Fading content
</div>

<!-- Stagger animations with inline styles -->
<div class="animate-fade-in" style="animation-delay: 0.2s;">
  Delayed animation
</div>
```

## Typography

### Font Families
- `font-inter` - Inter font (default body text)
- `font-poppins` - Poppins font (headings)

### Usage Examples
```html
<!-- Body text with Inter -->
<p class="font-inter">Regular body text</p>

<!-- Heading with Poppins -->
<h1 class="font-poppins text-3xl font-bold">
  Main Heading
</h1>
```

## Dark Mode

Dark mode is supported using the `dark:` prefix. Add the `dark` class to the `<html>` element to enable it.

### Usage Examples
```html
<!-- Light background, dark on dark mode -->
<div class="bg-white dark:bg-gray-900">
  <p class="text-gray-900 dark:text-white">
    Adaptive text color
  </p>
</div>
```

## Container

The container is configured to be centered with padding and a maximum width.

### Usage Example
```html
<div class="container mx-auto px-4">
  <!-- Content automatically centered with 2rem padding -->
  <!-- Max width of 1400px on 2xl screens -->
</div>
```

## Complete Example

Here's a complete example using multiple features:

```html
<div class="bg-lux-hero text-white py-20">
  <div class="container mx-auto px-4 text-center">
    <h1 class="text-5xl font-bold mb-4 font-poppins animate-fade-in">
      Prime Match Imo
    </h1>
    <p class="text-2xl mb-8 text-lux-ice animate-fade-in-up">
      Luxury real estate matching
    </p>
    <button class="bg-lux-gold hover:animate-glow text-lux-black px-8 py-3 rounded-lg text-lg font-semibold shadow-lux-glow transition-all">
      Get Started
    </button>
  </div>
</div>

<div class="py-16 bg-background">
  <div class="container mx-auto px-4">
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-lux-card p-6 rounded-lg shadow-lux-card animate-fade-in">
        <h3 class="text-xl font-bold mb-3 font-poppins">Feature One</h3>
        <p class="text-muted-foreground">Description</p>
      </div>
    </div>
  </div>
</div>
```

## Building Assets

After making changes to CSS or Tailwind configuration:

```bash
# Development mode with hot reload
npm run dev

# Production build
npm run build
```

## CSS Variables

All theme colors are defined as CSS variables and can be customized in `resources/css/app.css`:

```css
:root {
  --lux-gold: 43 96% 56%;
  --gradient-hero: linear-gradient(...);
  /* etc */
}
```

## Best Practices

1. Use `lux-*` colors for brand-specific elements
2. Use `font-poppins` for headings, `font-inter` for body text
3. Add `shadow-lux-card` to cards for consistent elevation
4. Use `shadow-lux-glow` sparingly for important CTAs
5. Apply animations with purpose - avoid overuse
6. Test dark mode when using custom colors
7. Use the container class for consistent page width

## Resources

- Tailwind CSS Documentation: https://tailwindcss.com/docs
- Project Tailwind Config: `tailwind.config.ts`
- CSS Variables: `resources/css/app.css`
