#!/usr/bin/env python3
"""Add a subtle rounded frame to README art PNGs (light mat + hairline border, no harsh shadow)."""

from __future__ import annotations

from pathlib import Path

from PIL import Image, ImageDraw

# Corners: keep modest so it does not read like a heavy “badge”
OUTER_RADIUS = 12
INNER_RADIUS = 10

# Barely off-white mat + one soft gray hairline (avoids gray “glow” from drop shadows on GitHub white)
LIGHT = (249, 250, 251, 255)  # slate-50
STROKE = (226, 232, 240, 255)  # slate-200

# README / GitHub renders PNGs on white; keep the whole file opaque (no transparent “halo”)
CANVAS_BG = (255, 255, 255, 255)

# Padding from outer card edge to screenshot
PAD = 10


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

    # Tight margin: no extra canvas for a blurred shadow (that was reading as “dirty” gray on white)
    margin = 6
    canvas_w = card_w + margin * 2
    canvas_h = card_h + margin * 2
    canvas = Image.new("RGBA", (canvas_w, canvas_h), CANVAS_BG)

    ox, oy = margin, margin

    card = Image.new("RGBA", (card_w, card_h), CANVAS_BG)
    cd = ImageDraw.Draw(card)
    cd.rounded_rectangle((0, 0, card_w - 1, card_h - 1), radius=OUTER_RADIUS, fill=LIGHT)
    cd.rounded_rectangle((0, 0, card_w - 1, card_h - 1), radius=OUTER_RADIUS, outline=STROKE, width=1)

    card.paste(im, (PAD, PAD), im)

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
