.PHONY : all show locale html images pack-images
.PHONY : install uninstall clean distclean arch www www-images srcdist bindist


all:
	@echo
	@echo "Please run \`./configure' first."
	@echo "To build a CLI-only version,"
	@echo "run \`CLI_ONLY=1 ./configure' instead."
	@echo "Note that dvdisaster requires GNU make to build."
	@echo "Under non-Linux systems, it might be known as \`gmake'."
	@echo

show: all
locale: all
html: all
images: all
pack-images: all
install: all
uninstall: all
clean: all
distclean: all
arch: all
www: all
www-images: all
srcdist: all
bindist: all

