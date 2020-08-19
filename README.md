# Image Border Removal

## Overview

For one of my mini-projects, I needed to download images and display them on a website. One quirk with images is that the images can come with a black border of variable size along the top and bottom.

An example of a YouTube thumbnail with a black border:

[https://i.ytimg.com/vi/dQw4w9WgXcQ/hqdefault.jpg](https://i.ytimg.com/vi/dQw4w9WgXcQ/hqdefault.jpg)

Just to make things more tricky, sometimes image borders are **not** pure rgb(0,0,0), this is likely to be a result of JPG compression noise. Some 'black' pixels in the border are off-black ( *e.g. rgb(0,5,2)* ) - invisible, yet enough of a problem to cause problems for most scripts.

<br>

## The Incomplete Solution
I originally looked at the script posted here: [https://stackoverflow.com/a/12851278](https://stackoverflow.com/a/12851278) 


<p align="center">
Original YouTube Thumbnail
</p>

<p align="center">
<img src="https://user-images.githubusercontent.com/7113258/90678022-0fe5ba80-e256-11ea-9cf9-12af2f21f0d8.jpg">
</p>

<p align="center">
Result of Stack Overflow Script
</p>

<p align="center">
<img src="https://user-images.githubusercontent.com/7113258/90678025-1116e780-e256-11ea-9b26-5caf8855ddaa.jpg">
</p>

As you can see, the image on the right still has black borders that stops short of the main image, this is because the script will stop removing the border as soon as it hits a pixel that is not rgb(0,0,0) which then results in an imperfect output.

<br>

## The Better Solution

The key task in re-writing the script was to increase the scope that the rgb index considers 'black'.

<p align="center">
Original YouTube Thumbnail
</p>

<p align="center">
<img src="https://user-images.githubusercontent.com/7113258/90678022-0fe5ba80-e256-11ea-9cf9-12af2f21f0d8.jpg">
</p>

<p align="center">
Result of Better Script
</p>

<p align="center">
<img src="https://user-images.githubusercontent.com/7113258/90678033-12e0ab00-e256-11ea-9baf-5225015cd2f9.jpg">
</p>

As you can see, the black border on both top and bottom is now completely removed.

<br>

## Other Stuff

### Tolerance Levels
The **$tolerance** variable defines the acceptable level of 'blackness', the default tolerance level is **25** which means the script will remove any lines where the first pixel is between the following indexes: rgb(0,0,0) to rgb(25,25,25).

### Left and Right Border Removal
If you also wish to remove left and right borders from images, the script is pretty simple and a relative newbie should be able to see how it works and add what's needed to achieve this.
