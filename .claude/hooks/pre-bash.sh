#!/bin/bash
# Hook Claude Code untuk merender command lewat RTK jika tersedia

# Ambil command yang akan dijalankan oleh Claude Code
COMMAND="$1"

# Jika rtk terinstall, bungkus command menggunakan rtk
if command -v rtk >/dev/null 2>&1; then
    exec rtk $COMMAND
else
    # Fallback ke command asli jika rtk tidak ditemukan
    exec $COMMAND
fi
