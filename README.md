# Flixarr

## Installation

### Production Installation

> Flixarr is not ready for production yet

### Development Installation

#### Step 1: Clone Flixarr

Open Git Bash, navigate to your install directory and run the following:

```bash
git clone https://github.com/Flixarr/Flixarr.git
```

Then `cd` into the app:

```bash
cd Flixarr
```

#### Step 2: Installing Dependencies

Run the following:

```
docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install
```

#### Step 3: Sail up!

To prevent from repeatedly typing `vendor/bin/sail` to exectue Sail commands, we will create a Bash alias:

```bash
alias sail='bash vendor/bin/sail'
```

Now, just sail up!

```bash
sail up
```

You're done!