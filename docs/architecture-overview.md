# Architecture Overview (Showcase)

Public summary of the bespoke theme approach used in enterprise client builds.

## Principles

1. **Pixel-perfect** — Original HTML/CSS/JS preserved per page; WordPress wraps, never replaces, the design.
2. **Safe editing** — ACF text/image/video fields only; no full-section WYSIWYG overrides.
3. **Minimal plugins** — Advanced Custom Fields as the single content plugin for admin UX.
4. **Performance-first** — Page-specific assets; no bloated page builders; 95+ mobile PageSpeed targets.
5. **CRM-ready** — HubSpot Forms API via server-side proxy (IP + cookie context).

## Stack

| Layer | Choice |
|-------|--------|
| CMS | WordPress 6.x |
| Content | ACF (options + per-page fields) |
| CRM | HubSpot Forms API v3 |
| SEO | Native theme module (Yoast-compatible) |
| Assets | One CSS + one JS bundle per template |

## Typical page structure

```
page-templates/template-{slug}.php
  └── template-parts/{slug}/section-*.php
        └── demo_text( 'field_key', 'Default copy from design' )
```

Full source code, field maps, and client documentation are provided under private engagement only.
