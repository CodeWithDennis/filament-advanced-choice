#!/usr/bin/env python3
"""Add rounded card frame (double border + soft shadow) to README art PNGs."""

from __future__ import annotations

from pathlib import Path

from PIL import Image, ImageDraw, ImageFilter

# Outer card (light frame + thin dark edge), inner screenshot corners
OUTER_RADIUS = 16
INNER_RADIUS = 12

# Warm off-white band, double-line dark accents (reference: terminal card UIs)
LIGHT = (245, 242, 235, 255)
OUTER_STROKE = (38, 38, 38, 255)
INNER_STROKE = (90, 90, 90, 255)

# README / GitHub renders PNGs on white; keep the whole file opaque (no transparent “halo”)
CANVAS_BG = (255, 255, 255, 255)

# Padding from outer card edge to screenshot
PAD = 14


def rounded_mask(size: tuple[int, int], radius: int) -> Image.Image:
    mask = Image.new("L", size, 0)
    draw = ImageDraw.Draw(mask)
    draw.rounded_rectangle((0, 0, size[0] - 1, size[1] - 1), radius=radius, fill=255)
    return mask


def flatten_on_white(im: Image.Image) -> Image.Image:
    """Remove checkerboard / fringe from source captures before masking."""
    im = im.convert("RGBA")
    base = Image.new("RGBA", im.size, CANVAS_BG)
    return Image.alpha_composite(base, im)


def round_corners(im: Image.Image, radius: int) -> Image.Image:
    im = im.convert("RGBA")
    m = rounded_mask(im.size, radius)
    out = Image.new("RGBA", im.size, CANVAS_BG)
    out.paste(im, (0, 0), m)
    return out


def frame_image(im: Image.Image) -> Image.Image:
    im = flatten_on_white(im)
    im = round_corners(im, INNER_RADIUS)
    w, h = im.size

    card_w = w + 2 * PAD
    card_h = h + 2 * PAD

    shadow_pad = 14
    canvas_w = card_w + shadow_pad * 2
    canvas_h = card_h + shadow_pad * 2
    # Opaque base so nothing outside the card is transparent (avoids gray halos on GitHub / dark UIs)
    canvas = Image.new("RGBA", (canvas_w, canvas_h), CANVAS_BG)

    ox, oy = shadow_pad, shadow_pad

    # Soft drop shadow (blended onto white, then flattened)
    shadow = Image.new("RGBA", (card_w + 24, card_h + 24), (0, 0, 0, 0))
    sd = ImageDraw.Draw(shadow)
    sd.rounded_rectangle(
        (12, 12, card_w + 11, card_h + 11),
        radius=OUTER_RADIUS + 2,
        fill=(0, 0, 0, 70),
    )
    shadow = shadow.filter(ImageFilter.GaussianBlur(16))
    canvas.alpha_composite(shadow, (ox - 12, oy - 8))

    # Light card + outer stroke (double effect outer line)
    card = Image.new("RGBA", (card_w, card_h), CANVAS_BG)
    cd = ImageDraw.Draw(card)
    cd.rounded_rectangle((0, 0, card_w - 1, card_h - 1), radius=OUTER_RADIUS, fill=LIGHT)
    cd.rounded_rectangle((0, 0, card_w - 1, card_h - 1), radius=OUTER_RADIUS, outline=OUTER_STROKE, width=1)

    card.paste(im, (PAD, PAD), im)

    # Inner stroke hugging the screenshot (second line of the double frame)
    ix0, iy0 = PAD - 1, PAD - 1
    ix1, iy1 = PAD + w, PAD + h
    cd.rounded_rectangle(
        (ix0, iy0, ix1 - 1, iy1 - 1),
        radius=INNER_RADIUS + 1,
        outline=INNER_STROKE,
        width=1,
    )

    canvas.alpha_composite(card, (ox, oy))
    # No alpha channel: every pixel is opaque README-friendly white outside the frame
    return canvas.convert("RGB")


def main() -> None:
    root = Path(__file__).resolve().parent.parent / "art"
    for path in sorted(root.glob("*.png")):
        img = Image.open(path)
        out = frame_image(img)
        tmp = path.with_suffix(".png.tmp")
        out.save(tmp, format="PNG", optimize=True)
        tmp.replace(path)
        print(path.name)


if __name__ == "__main__":
    main()
