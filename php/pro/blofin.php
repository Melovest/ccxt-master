<?php

namespace ccxt\pro;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use ccxt\ExchangeError;
use ccxt\ArgumentsRequired;
use ccxt\NotSupported;
use React\Async;
use React\Promise\PromiseInterface;

class blofin extends \ccxt\async\blofin {

    public function describe() {
        return $this->deep_extend(parent::describe(), array(
            'has' => array(
                'ws' => true,
                'watchTrades' => true,
                'watchTradesForSymbols' => true,
                'watchOrderBook' => true,
                'watchOrderBookForSymbols' => true,
                'watchTicker' => true,
                'watchTickers' => true,
                'watchBidsAsks' => true,
                'watchOHLCV' => true,
                'watchOHLCVForSymbols' => true,
                'watchOrders' => true,
                'watchOrdersForSymbols' => true,
                'watchPositions' => true,
            ),
            'urls' => array(
                'api' => array(
                    'ws' => array(
                        'swap' => array(
                            'public' => 'wss://openapi.blofin.com/ws/public',
                            'private' => 'wss://openapi.blofin.com/ws/private',
                        ),
                    ),
                ),
            ),
            'options' => array(
                'defaultType' => 'swap',
                'tradesLimit' => 1000,
                // orderbook channel can be one from:
                //  - "books" => 200 depth levels will be pushed in the initial full snapshot. Incremental data will be pushed every 100 ms for the changes in the order book during that period of time.
                //  - "books5" => 5 depth levels snapshot will be pushed every time. Snapshot data will be pushed every 100 ms when there are changes in the 5 depth levels snapshot.
                'watchOrderBook' => array(
                    'channel' => 'books',
                ),
                'watchOrderBookForSymbols' => array(
                    'channel' => 'books',
                ),
            ),
            'streaming' => array(
                'ping' => array($this, 'ping'),
                'keepAlive' => 25000, // 30 seconds max
            ),
        ));
    }

    public function ping($client) {
        return 'ping';
    }

    public function handle_pong(Client $client, $message) {
        //
        //   'pong'
        //
        $client->lastPong = $this->milliseconds();
    }

    public function watch_trades(string $symbol, ?int $since = null, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $since, $limit, $params) {
            /**
             * get the list of most recent trades for a particular $symbol
             *
             * @see https://docs.blofin.com/index.html#ws-trades-channel
             *
             * @param {string} $symbol unified $symbol of the market to fetch trades for
             * @param {int} [$since] timestamp in ms of the earliest trade to fetch
             * @param {int} [$limit] the maximum amount of trades to fetch
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array[]} a list of ~@link https://docs.ccxt.com/#/?id=public-trades trade structures~
             */
            $params['callerMethodName'] = 'watchTrades';
            return Async\await($this->watch_trades_for_symbols(array( $symbol ), $since, $limit, $params));
        }) ();
    }

    public function watch_trades_for_symbols(array $symbols, ?int $since = null, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbols, $since, $limit, $params) {
            /**
             * get the list of most recent $trades for a list of $symbols
             *
             * @see https://docs.blofin.com/index.html#ws-$trades-channel
             *
             * @param {string[]} $symbols unified symbol of the market to fetch $trades for
             * @param {int} [$since] timestamp in ms of the earliest trade to fetch
             * @param {int} [$limit] the maximum amount of $trades to fetch
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array[]} a list of ~@link https://docs.ccxt.com/#/?id=public-$trades trade structures~
             */
            Async\await($this->load_markets());
            $trades = Async\await($this->watch_multiple_wrapper(true, 'trades', 'watchTradesForSymbols', $symbols, $params));
            if ($this->newUpdates) {
                $firstMarket = $this->safe_dict($trades, 0);
                $firstSymbol = $this->safe_string($firstMarket, 'symbol');
                $limit = $trades->getLimit ($firstSymbol, $limit);
            }
            return $this->filter_by_since_limit($trades, $since, $limit, 'timestamp', true);
        }) ();
    }

    public function handle_trades(Client $client, $message) {
        //
        //     {
        //       $arg => array(
        //         channel => "trades",
        //         instId => "DOGE-USDT",
        //       ),
        //       $data : array(
        //         <same object in REST example>,
        //         ...
        //       )
        //     }
        //
        $arg = $this->safe_dict($message, 'arg');
        $channelName = $this->safe_string($arg, 'channel');
        $data = $this->safe_list($message, 'data');
        if ($data === null) {
            return;
        }
        for ($i = 0; $i < count($data); $i++) {
            $rawTrade = $data[$i];
            $trade = $this->parse_ws_trade($rawTrade);
            $symbol = $trade['symbol'];
            $stored = $this->safe_value($this->trades, $symbol);
            if ($stored === null) {
                $limit = $this->safe_integer($this->options, 'tradesLimit', 1000);
                $stored = new ArrayCache ($limit);
                $this->trades[$symbol] = $stored;
            }
            $stored->append ($trade);
            $messageHash = $channelName . ':' . $symbol;
            $client->resolve ($stored, $messageHash);
        }
    }

    public function parse_ws_trade($trade, ?array $market = null): array {
        return $this->parse_trade($trade, $market);
    }

    public function watch_order_book(string $symbol, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $limit, $params) {
            /**
             * watches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
             *
             * @see https://docs.blofin.com/index.html#ws-order-book-channel
             *
             * @param {string} $symbol unified $symbol of the market to fetch the order book for
             * @param {int} [$limit] the maximum amount of order book entries to return
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array} A dictionary of ~@link https://docs.ccxt.com/#/?id=order-book-structure order book structures~ indexed by market symbols
             */
            $params['callerMethodName'] = 'watchOrderBook';
            return Async\await($this->watch_order_book_for_symbols(array( $symbol ), $limit, $params));
        }) ();
    }

    public function watch_order_book_for_symbols(array $symbols, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbols, $limit, $params) {
            /**
             * watches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
             *
             * @see https://docs.blofin.com/index.html#ws-order-book-channel
             *
             * @param {string[]} $symbols unified array of $symbols
             * @param {int} [$limit] the maximum amount of order book entries to return
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @param {string} [$params->depth] the type of order book to subscribe to, default is 'depth/increase100', also accepts 'depth5' or 'depth20' or depth50
             * @return {array} A dictionary of ~@link https://docs.ccxt.com/#/?id=order-book-structure order book structures~ indexed by market $symbols
             */
            Async\await($this->load_markets());
            $callerMethodName = null;
            list($callerMethodName, $params) = $this->handle_param_string($params, 'callerMethodName', 'watchOrderBookForSymbols');
            $channelName = null;
            list($channelName, $params) = $this->handle_option_and_params($params, $callerMethodName, 'channel', 'books');
            // due to some problem, temporarily disable other channels
            if ($channelName !== 'books') {
                throw new NotSupported($this->id . ' ' . $callerMethodName . '() at this moment ' . $channelName . ' is not supported, coming soon');
            }
            $orderbook = Async\await($this->watch_multiple_wrapper(true, $channelName, $callerMethodName, $symbols, $params));
            return $orderbook->limit ();
        }) ();
    }

    public function handle_order_book(Client $client, $message) {
        //
        //   {
        //     $arg => array(
        //         channel => "books",
        //         instId => "DOGE-USDT",
        //     ),
        //     $action => "snapshot", // can be 'snapshot' or 'update'
        //     $data => array(
        //         $asks => array(   array( 0.08096, 1 ), array( 0.08097, 123 ), ...   ),
        //         $bids => array(   array( 0.08095, 4 ), array( 0.08094, 237 ), ...   ),
        //         ts => "1707491587909",
        //         prevSeqId => "0", // in case of 'update' there will be some value, less then seqId
        //         seqId => "3374250786",
        //     ),
        // }
        //
        $arg = $this->safe_dict($message, 'arg');
        $channelName = $this->safe_string($arg, 'channel');
        $data = $this->safe_dict($message, 'data');
        $marketId = $this->safe_string($arg, 'instId');
        $market = $this->safe_market($marketId);
        $symbol = $market['symbol'];
        $messageHash = $channelName . ':' . $symbol;
        if (!(is_array($this->orderbooks) && array_key_exists($symbol, $this->orderbooks))) {
            $this->orderbooks[$symbol] = $this->order_book();
        }
        $orderbook = $this->orderbooks[$symbol];
        $timestamp = $this->safe_integer($data, 'ts');
        $action = $this->safe_string($message, 'action');
        if ($action === 'snapshot') {
            $orderBookSnapshot = $this->parse_order_book($data, $symbol, $timestamp);
            $orderBookSnapshot['nonce'] = $this->safe_integer($data, 'seqId');
            $orderbook->reset ($orderBookSnapshot);
        } else {
            $asks = $this->safe_list($data, 'asks', array());
            $bids = $this->safe_list($data, 'bids', array());
            $this->handle_deltas_with_keys($orderbook['asks'], $asks);
            $this->handle_deltas_with_keys($orderbook['bids'], $bids);
            $orderbook['timestamp'] = $timestamp;
            $orderbook['datetime'] = $this->iso8601($timestamp);
        }
        $this->orderbooks[$symbol] = $orderbook;
        $client->resolve ($orderbook, $messageHash);
    }

    public function watch_ticker(string $symbol, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $params) {
            /**
             * watches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific $market
             *
             * @see https://docs.blofin.com/index.html#ws-tickers-channel
             *
             * @param {string} $symbol unified $symbol of the $market to fetch the ticker for
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array} a ~@link https://docs.ccxt.com/#/?id=ticker-structure ticker structure~
             */
            $params['callerMethodName'] = 'watchTicker';
            $market = $this->market($symbol);
            $symbol = $market['symbol'];
            $result = Async\await($this->watch_tickers(array( $symbol ), $params));
            return $result[$symbol];
        }) ();
    }

    public function watch_tickers(?array $symbols = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbols, $params) {
            /**
             * watches a price $ticker, a statistical calculation with the information calculated over the past 24 hours for all markets of a specific list
             *
             * @see https://docs.blofin.com/index.html#ws-$tickers-channel
             *
             * @param {string[]} $symbols unified symbol of the market to fetch the $ticker for
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array} a ~@link https://docs.ccxt.com/#/?id=$ticker-structure $ticker structure~
             */
            if ($symbols === null) {
                throw new NotSupported($this->id . ' watchTickers() requires a list of symbols');
            }
            $ticker = Async\await($this->watch_multiple_wrapper(true, 'tickers', 'watchTickers', $symbols, $params));
            if ($this->newUpdates) {
                $tickers = array();
                $tickers[$ticker['symbol']] = $ticker;
                return $tickers;
            }
            return $this->filter_by_array($this->tickers, 'symbol', $symbols);
        }) ();
    }

    public function handle_ticker(Client $client, $message) {
        //
        // $message
        //
        //     {
        //         $arg => array(
        //             channel => "tickers",
        //             instId => "DOGE-USDT",
        //         ),
        //         $data => array(
        //             <same object in REST example>
        //         ),
        //     }
        //
        $this->handle_bid_ask($client, $message);
        $arg = $this->safe_dict($message, 'arg');
        $channelName = $this->safe_string($arg, 'channel');
        $data = $this->safe_list($message, 'data');
        for ($i = 0; $i < count($data); $i++) {
            $ticker = $this->parse_ws_ticker($data[$i]);
            $symbol = $ticker['symbol'];
            $messageHash = $channelName . ':' . $symbol;
            $this->tickers[$symbol] = $ticker;
            $client->resolve ($this->tickers[$symbol], $messageHash);
        }
    }

    public function parse_ws_ticker($ticker, ?array $market = null): array {
        return $this->parse_ticker($ticker, $market);
    }

    public function watch_bids_asks(?array $symbols = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbols, $params) {
            /**
             * watches best bid & ask for $symbols
             *
             * @see https://docs.blofin.com/index.html#ws-$tickers-$channel
             *
             * @param {string[]} $symbols unified symbol of the $market to fetch the $ticker for
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array} a ~@link https://docs.ccxt.com/#/?id=$ticker-structure $ticker structure~
             */
            Async\await($this->load_markets());
            $symbols = $this->market_symbols($symbols, null, false);
            $firstMarket = $this->market($symbols[0]);
            $channel = 'tickers';
            $marketType = null;
            list($marketType, $params) = $this->handle_market_type_and_params('watchBidsAsks', $firstMarket, $params);
            $url = $this->implode_hostname($this->urls['api']['ws'][$marketType]['public']);
            $messageHashes = array();
            $args = array();
            for ($i = 0; $i < count($symbols); $i++) {
                $market = $this->market($symbols[$i]);
                $messageHashes[] = 'bidask:' . $market['symbol'];
                $args[] = array(
                    'channel' => $channel,
                    'instId' => $market['id'],
                );
            }
            $request = $this->get_subscription_request($args);
            $ticker = Async\await($this->watch_multiple($url, $messageHashes, $this->deep_extend($request, $params), $messageHashes));
            if ($this->newUpdates) {
                $tickers = array();
                $tickers[$ticker['symbol']] = $ticker;
                return $tickers;
            }
            return $this->filter_by_array($this->bidsasks, 'symbol', $symbols);
        }) ();
    }

    public function handle_bid_ask(Client $client, $message) {
        $data = $this->safe_list($message, 'data');
        for ($i = 0; $i < count($data); $i++) {
            $ticker = $this->parse_ws_bid_ask($data[$i]);
            $symbol = $ticker['symbol'];
            $messageHash = 'bidask:' . $symbol;
            $this->bidsasks[$symbol] = $ticker;
            $client->resolve ($ticker, $messageHash);
        }
    }

    public function parse_ws_bid_ask($ticker, $market = null) {
        $marketId = $this->safe_string($ticker, 'instId');
        $market = $this->safe_market($marketId, $market, '-');
        $symbol = $this->safe_string($market, 'symbol');
        $timestamp = $this->safe_integer($ticker, 'ts');
        return $this->safe_ticker(array(
            'symbol' => $symbol,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'ask' => $this->safe_string($ticker, 'askPrice'),
            'askVolume' => $this->safe_string($ticker, 'askSize'),
            'bid' => $this->safe_string($ticker, 'bidPrice'),
            'bidVolume' => $this->safe_string($ticker, 'bidSize'),
            'info' => $ticker,
        ), $market);
    }

    public function watch_ohlcv(string $symbol, $timeframe = '1m', ?int $since = null, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $timeframe, $since, $limit, $params) {
            /**
             * watches historical candlestick data containing the open, high, low, and close price, and the volume of a market
             * @param {string} $symbol unified $symbol of the market to fetch OHLCV data for
             * @param {string} $timeframe the length of time each candle represents
             * @param {int} [$since] timestamp in ms of the earliest candle to fetch
             * @param {int} [$limit] the maximum amount of candles to fetch
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {int[][]} A list of candles ordered, open, high, low, close, volume
             */
            $params['callerMethodName'] = 'watchOHLCV';
            $result = Async\await($this->watch_ohlcv_for_symbols(array( array( $symbol, $timeframe ) ), $since, $limit, $params));
            return $result[$symbol][$timeframe];
        }) ();
    }

    public function watch_ohlcv_for_symbols(array $symbolsAndTimeframes, ?int $since = null, ?int $limit = null, $params = array ()) {
        return Async\async(function () use ($symbolsAndTimeframes, $since, $limit, $params) {
            /**
             * watches historical candlestick data containing the open, high, low, and close price, and the volume of a market
             *
             * @see https://docs.blofin.com/index.html#ws-candlesticks-channel
             *
             * @param {string[][]} $symbolsAndTimeframes array of arrays containing unified symbols and timeframes to fetch OHLCV data for, example [['BTC/USDT', '1m'], ['LTC/USDT', '5m']]
             * @param {int} [$since] timestamp in ms of the earliest candle to fetch
             * @param {int} [$limit] the maximum amount of $candles to fetch
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {int[][]} A list of $candles ordered, open, high, low, close, volume
             */
            $symbolsLength = count($symbolsAndTimeframes);
            if ($symbolsLength === 0 || gettype($symbolsAndTimeframes[0]) !== 'array' || array_keys($symbolsAndTimeframes[0]) !== array_keys(array_keys($symbolsAndTimeframes[0]))) {
                throw new ArgumentsRequired($this->id . " watchOHLCVForSymbols() requires a an array of symbols and timeframes, like  [['BTC/USDT', '1m'], ['LTC/USDT', '5m']]");
            }
            Async\await($this->load_markets());
            list($symbol, $timeframe, $candles) = Async\await($this->watch_multiple_wrapper(true, 'candle', 'watchOHLCVForSymbols', $symbolsAndTimeframes, $params));
            if ($this->newUpdates) {
                $limit = $candles->getLimit ($symbol, $limit);
            }
            $filtered = $this->filter_by_since_limit($candles, $since, $limit, 0, true);
            return $this->create_ohlcv_object($symbol, $timeframe, $filtered);
        }) ();
    }

    public function handle_ohlcv(Client $client, $message) {
        //
        // $message
        //
        //     {
        //         $arg => array(
        //             channel => "candle1m",
        //             instId => "DOGE-USDT",
        //         ),
        //         $data => array(
        //             array( same object in REST example )
        //         ),
        //     }
        //
        $arg = $this->safe_dict($message, 'arg');
        $channelName = $this->safe_string($arg, 'channel');
        $data = $this->safe_list($message, 'data');
        $marketId = $this->safe_string($arg, 'instId');
        $market = $this->safe_market($marketId);
        $symbol = $market['symbol'];
        $interval = str_replace('candle', '', $channelName);
        $unifiedTimeframe = $this->find_timeframe($interval);
        $this->ohlcvs[$symbol] = $this->safe_dict($this->ohlcvs, $symbol, array());
        $stored = $this->safe_value($this->ohlcvs[$symbol], $unifiedTimeframe);
        if ($stored === null) {
            $limit = $this->safe_integer($this->options, 'OHLCVLimit', 1000);
            $stored = new ArrayCacheByTimestamp ($limit);
            $this->ohlcvs[$symbol][$unifiedTimeframe] = $stored;
        }
        for ($i = 0; $i < count($data); $i++) {
            $candle = $data[$i];
            $parsed = $this->parse_ohlcv($candle, $market);
            $stored->append ($parsed);
        }
        $resolveData = array( $symbol, $unifiedTimeframe, $stored );
        $messageHash = 'candle' . $interval . ':' . $symbol;
        $client->resolve ($resolveData, $messageHash);
    }

    public function watch_balance($params = array ()): PromiseInterface {
        return Async\async(function () use ($params) {
            /**
             * query for balance and get the amount of funds available for trading or funds locked in orders
             *
             * @see https://docs.blofin.com/index.html#ws-account-channel
             *
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array} a ~@link https://docs.ccxt.com/#/?id=balance-structure balance structure~
             */
            Async\await($this->load_markets());
            Async\await($this->authenticate());
            $marketType = null;
            list($marketType, $params) = $this->handle_market_type_and_params('watchBalance', null, $params);
            if ($marketType === 'spot') {
                throw new NotSupported($this->id . ' watchBalance() is not supported for spot markets yet');
            }
            $messageHash = $marketType . ':balance';
            $sub = array(
                'channel' => 'account',
            );
            $request = $this->get_subscription_request(array( $sub ));
            $url = $this->implode_hostname($this->urls['api']['ws'][$marketType]['private']);
            return Async\await($this->watch($url, $messageHash, $this->deep_extend($request, $params), $messageHash));
        }) ();
    }

    public function handle_balance(Client $client, $message) {
        //
        //     {
        //         arg => array(
        //           channel => "account",
        //         ),
        //         data => <same object in REST example>,
        //     }
        //
        $marketType = 'swap'; // for now
        if (!(is_array($this->balance) && array_key_exists($marketType, $this->balance))) {
            $this->balance[$marketType] = array();
        }
        $this->balance[$marketType] = $this->parse_ws_balance($message);
        $messageHash = $marketType . ':balance';
        $client->resolve ($this->balance[$marketType], $messageHash);
    }

    public function parse_ws_balance($message) {
        return $this->parse_balance($message);
    }

    public function watch_orders(?string $symbol = null, ?int $since = null, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $since, $limit, $params) {
            /**
             * watches information on multiple orders made by the user
             * @param {string} $symbol unified market $symbol of the market orders were made in
             * @param {int} [$since] the earliest time in ms to fetch orders for
             * @param {int} [$limit] the maximum number of order structures to retrieve
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array[]} a list of [order structures]{@link https://docs.ccxt.com/#/?id=order-structure
             */
            $params['callerMethodName'] = 'watchOrders';
            $symbolsArray = ($symbol !== null) ? array( $symbol ) : array();
            return Async\await($this->watch_orders_for_symbols($symbolsArray, $since, $limit, $params));
        }) ();
    }

    public function watch_orders_for_symbols(array $symbols, ?int $since = null, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbols, $since, $limit, $params) {
            /**
             * watches information on multiple $orders made by the user across multiple $symbols
             *
             * @see https://docs.blofin.com/index.html#ws-order-channel
             *
             * @param {string[]} $symbols
             * @param {int} [$since] the earliest time in ms to fetch $orders for
             * @param {int} [$limit] the maximum number of order structures to retrieve
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array[]} a list of [order structures]{@link https://docs.ccxt.com/#/?id=order-structure
             */
            Async\await($this->authenticate());
            Async\await($this->load_markets());
            $orders = Async\await($this->watch_multiple_wrapper(false, 'orders', 'watchOrdersForSymbols', $symbols, $params));
            if ($this->newUpdates) {
                $first = $this->safe_value($orders, 0);
                $tradeSymbol = $this->safe_string($first, 'symbol');
                $limit = $orders->getLimit ($tradeSymbol, $limit);
            }
            return $this->filter_by_since_limit($orders, $since, $limit, 'timestamp', true);
        }) ();
    }

    public function handle_orders(Client $client, $message) {
        //
        //     {
        //         action => 'update',
        //         $arg => array( channel => 'orders' ),
        //         $data => array(
        //           <same object in REST example>
        //         )
        //     }
        //
        if ($this->orders === null) {
            $limit = $this->safe_integer($this->options, 'ordersLimit', 1000);
            $this->orders = new ArrayCacheBySymbolById ($limit);
        }
        $orders = $this->orders;
        $arg = $this->safe_dict($message, 'arg');
        $channelName = $this->safe_string($arg, 'channel');
        $data = $this->safe_list($message, 'data');
        for ($i = 0; $i < count($data); $i++) {
            $order = $this->parse_ws_order($data[$i]);
            $symbol = $order['symbol'];
            $messageHash = $channelName . ':' . $symbol;
            $orders->append ($order);
            $client->resolve ($orders, $messageHash);
            $client->resolve ($orders, $channelName);
        }
    }

    public function parse_ws_order($order, ?array $market = null): array {
        return $this->parse_order($order, $market);
    }

    public function watch_positions(?array $symbols = null, ?int $since = null, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbols, $since, $limit, $params) {
            /**
             *
             * @see https://docs.blofin.com/index.html#ws-positions-channel
             *
             * watch all open positions
             * @param {string[]|null} $symbols list of unified market $symbols
             * @param {int} [$since] the earliest time in ms to fetch positions for
             * @param {int} [$limit] the maximum number of positions to retrieve
             * @param {array} $params extra parameters specific to the exchange API endpoint
             * @return {array[]} a list of {@link https://docs.ccxt.com/en/latest/manual.html#position-structure position structure}
             */
            Async\await($this->authenticate());
            Async\await($this->load_markets());
            $newPositions = Async\await($this->watch_multiple_wrapper(false, 'positions', 'watchPositions', $symbols, $params));
            if ($this->newUpdates) {
                return $newPositions;
            }
            return $this->filter_by_symbols_since_limit($this->positions, $symbols, $since, $limit);
        }) ();
    }

    public function handle_positions(Client $client, $message) {
        //
        //     {
        //         $arg => array( channel => 'positions' ),
        //         $data => array(
        //           <same object in REST example>
        //         )
        //     }
        //
        if ($this->positions === null) {
            $this->positions = new ArrayCacheBySymbolBySide ();
        }
        $cache = $this->positions;
        $arg = $this->safe_dict($message, 'arg');
        $channelName = $this->safe_string($arg, 'channel');
        $data = $this->safe_list($message, 'data');
        $newPositions = array();
        for ($i = 0; $i < count($data); $i++) {
            $position = $this->parse_ws_position($data[$i]);
            $newPositions[] = $position;
            $cache->append ($position);
            $messageHash = $channelName . ':' . $position['symbol'];
            $client->resolve ($position, $messageHash);
        }
    }

    public function parse_ws_position($position, ?array $market = null): Position {
        return $this->parse_position($position, $market);
    }

    public function watch_multiple_wrapper(bool $isPublic, string $channelName, string $callerMethodName, ?array $symbolsArray = null, $params = array ()) {
        return Async\async(function () use ($isPublic, $channelName, $callerMethodName, $symbolsArray, $params) {
            // underlier method for all watch-multiple $symbols
            Async\await($this->load_markets());
            list($callerMethodName, $params) = $this->handle_param_string($params, 'callerMethodName', $callerMethodName);
            // if OHLCV method are being called, then $symbols would be symbolsAndTimeframes (multi-dimensional) array
            $isOHLCV = ($channelName === 'candle');
            $symbols = $isOHLCV ? $this->get_list_from_object_values($symbolsArray, 0) : $symbolsArray;
            $symbols = $this->market_symbols($symbols, null, true, true);
            $firstMarket = null;
            $firstSymbol = $this->safe_string($symbols, 0);
            if ($firstSymbol !== null) {
                $firstMarket = $this->market($firstSymbol);
            }
            $marketType = null;
            list($marketType, $params) = $this->handle_market_type_and_params($callerMethodName, $firstMarket, $params);
            if ($marketType !== 'swap') {
                throw new NotSupported($this->id . ' ' . $callerMethodName . '() does not support ' . $marketType . ' markets yet');
            }
            $rawSubscriptions = array();
            $messageHashes = array();
            if ($symbols === null) {
                $symbols = array();
            }
            $symbolsLength = count($symbols);
            if ($symbolsLength > 0) {
                for ($i = 0; $i < count($symbols); $i++) {
                    $current = $symbols[$i];
                    $market = null;
                    $channel = $channelName;
                    if ($isOHLCV) {
                        $market = $this->market($current);
                        $tfArray = $symbolsArray[$i];
                        $tf = $tfArray[1];
                        $interval = $this->safe_string($this->timeframes, $tf, $tf);
                        $channel .= $interval;
                    } else {
                        $market = $this->market($current);
                    }
                    $topic = array(
                        'channel' => $channel,
                        'instId' => $market['id'],
                    );
                    $rawSubscriptions[] = $topic;
                    $messageHashes[] = $channel . ':' . $market['symbol'];
                }
            } else {
                $rawSubscriptions[] = array( 'channel' => $channelName );
                $messageHashes[] = $channelName;
            }
            // private $channel are difference, they only need plural $channel name for multiple $symbols
            if ($this->in_array($channelName, array( 'orders', 'positions' ))) {
                $rawSubscriptions = array( array( 'channel' => $channelName ) );
            }
            $request = $this->get_subscription_request($rawSubscriptions);
            $privateOrPublic = $isPublic ? 'public' : 'private';
            $url = $this->implode_hostname($this->urls['api']['ws'][$marketType][$privateOrPublic]);
            return Async\await($this->watch_multiple($url, $messageHashes, $this->deep_extend($request, $params), $messageHashes));
        }) ();
    }

    public function get_subscription_request($args) {
        return array(
            'op' => 'subscribe',
            'args' => $args,
        );
    }

    public function handle_message(Client $client, $message) {
        //
        // $message examples
        //
        // {
        //   $arg => array(
        //     channel => "trades",
        //     instId => "DOGE-USDT",
        //   ),
        //   $event => "subscribe"
        // }
        //
        // incoming data updates' examples can be seen under each handler $method
        //
        $methods = array(
            // public
            'pong' => array($this, 'handle_pong'),
            'trades' => array($this, 'handle_trades'),
            'books' => array($this, 'handle_order_book'),
            'tickers' => array($this, 'handle_ticker'),
            'candle' => array($this, 'handle_ohlcv'), // candle1m, candle5m, etc
            // private
            'account' => array($this, 'handle_balance'),
            'orders' => array($this, 'handle_orders'),
            'positions' => array($this, 'handle_positions'),
        );
        $method = null;
        if ($message === 'pong') {
            $method = $this->safe_value($methods, 'pong');
        } else {
            $event = $this->safe_string($message, 'event');
            if ($event === 'subscribe') {
                return;
            } elseif ($event === 'login') {
                $future = $this->safe_value($client->futures, 'authenticate_hash');
                $future->resolve (true);
                return;
            } elseif ($event === 'error') {
                throw new ExchangeError($this->id . ' error => ' . $this->json($message));
            }
            $arg = $this->safe_dict($message, 'arg');
            $channelName = $this->safe_string($arg, 'channel');
            $method = $this->safe_value($methods, $channelName);
            if (!$method && mb_strpos($channelName, 'candle') !== false) {
                $method = $methods['candle'];
            }
        }
        if ($method) {
            $method($client, $message);
        }
    }

    public function authenticate($params = array ()) {
        return Async\async(function () use ($params) {
            $this->check_required_credentials();
            $milliseconds = $this->milliseconds();
            $messageHash = 'authenticate_hash';
            $timestamp = (string) $milliseconds;
            $nonce = 'n_' . $timestamp;
            $auth = '/users/self/verify' . 'GET' . $timestamp . '' . $nonce;
            $signature = base64_encode($this->hmac($this->encode($auth), $this->encode($this->secret), 'sha256'));
            $request = array(
                'op' => 'login',
                'args' => array(
                    array(
                        'apiKey' => $this->apiKey,
                        'passphrase' => $this->password,
                        'timestamp' => $timestamp,
                        'nonce' => $nonce,
                        'sign' => $signature,
                    ),
                ),
            );
            $marketType = 'swap'; // for now
            $url = $this->implode_hostname($this->urls['api']['ws'][$marketType]['private']);
            Async\await($this->watch($url, $messageHash, $this->deep_extend($request, $params), $messageHash));
        }) ();
    }
}