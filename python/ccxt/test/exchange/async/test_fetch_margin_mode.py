import os
import sys

root = os.path.dirname(os.path.dirname(os.path.dirname(os.path.dirname(os.path.dirname(os.path.abspath(__file__))))))
sys.path.append(root)

# ----------------------------------------------------------------------------

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

# ----------------------------------------------------------------------------
# -*- coding: utf-8 -*-

from ccxt.test.exchange.base import test_margin_mode  # noqa E402

async def test_fetch_margin_mode(exchange, skipped_properties, symbol):
    method = 'fetchMarginMode'
    margin_mode = await exchange.fetch_margin_mode(symbol)
    test_margin_mode(exchange, skipped_properties, method, margin_mode)