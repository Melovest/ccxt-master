namespace ccxt.pro;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


public partial class huobijp { public huobijp(object args = null) : base(args) { } }
public partial class huobijp : ccxt.huobijp
{
    public override object describe()
    {
        return this.deepExtend(base.describe(), new Dictionary<string, object>() {
            { "has", new Dictionary<string, object>() {
                { "ws", true },
                { "watchOrderBook", true },
                { "watchTickers", false },
                { "watchTicker", true },
                { "watchTrades", true },
                { "watchTradesForSymbols", false },
                { "watchBalance", false },
                { "watchOHLCV", true },
            } },
            { "urls", new Dictionary<string, object>() {
                { "api", new Dictionary<string, object>() {
                    { "ws", new Dictionary<string, object>() {
                        { "api", new Dictionary<string, object>() {
                            { "public", "wss://{hostname}/ws" },
                            { "private", "wss://{hostname}/ws/v2" },
                        } },
                    } },
                } },
            } },
            { "options", new Dictionary<string, object>() {
                { "tradesLimit", 1000 },
                { "OHLCVLimit", 1000 },
                { "api", "api" },
                { "ws", new Dictionary<string, object>() {
                    { "gunzip", true },
                } },
            } },
        });
    }

    public virtual object requestId()
    {
        object requestId = this.sum(this.safeInteger(this.options, "requestId", 0), 1);
        ((IDictionary<string,object>)this.options)["requestId"] = requestId;
        return ((object)requestId).ToString();
    }

    /**
     * @method
     * @name huobijp#watchTicker
     * @description watches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
     * @param {string} symbol unified symbol of the market to fetch the ticker for
     * @param {object} [params] extra parameters specific to the exchange API endpoint
     * @returns {object} a [ticker structure]{@link https://docs.ccxt.com/#/?id=ticker-structure}
     */
    public async override Task<object> watchTicker(object symbol, object parameters = null)
    {
        parameters ??= new Dictionary<string, object>();
        await this.loadMarkets();
        object market = this.market(symbol);
        symbol = getValue(market, "symbol");
        // only supports a limit of 150 at this time
        object messageHash = add(add("market.", getValue(market, "id")), ".detail");
        object api = this.safeString(this.options, "api", "api");
        object hostname = new Dictionary<string, object>() {
            { "hostname", this.hostname },
        };
        object url = this.implodeParams(getValue(getValue(getValue(getValue(this.urls, "api"), "ws"), api), "public"), hostname);
        object requestId = this.requestId();
        object request = new Dictionary<string, object>() {
            { "sub", messageHash },
            { "id", requestId },
        };
        object subscription = new Dictionary<string, object>() {
            { "id", requestId },
            { "messageHash", messageHash },
            { "symbol", symbol },
            { "params", parameters },
        };
        return await this.watch(url, messageHash, this.extend(request, parameters), messageHash, subscription);
    }

    public virtual object handleTicker(WebSocketClient client, object message)
    {
        //
        //     {
        //         "ch": "market.btcusdt.detail",
        //         "ts": 1583494163784,
        //         "tick": {
        //             "id": 209988464418,
        //             "low": 8988,
        //             "high": 9155.41,
        //             "open": 9078.91,
        //             "close": 9136.46,
        //             "vol": 237813910.5928412,
        //             "amount": 26184.202558551195,
        //             "version": 209988464418,
        //             "count": 265673
        //         }
        //     }
        //
        object tick = this.safeValue(message, "tick", new Dictionary<string, object>() {});
        object ch = this.safeString(message, "ch");
        object parts = ((string)ch).Split(new [] {((string)".")}, StringSplitOptions.None).ToList<object>();
        object marketId = this.safeString(parts, 1);
        object market = this.safeMarket(marketId);
        object ticker = this.parseTicker(tick, market);
        object timestamp = this.safeValue(message, "ts");
        ((IDictionary<string,object>)ticker)["timestamp"] = timestamp;
        ((IDictionary<string,object>)ticker)["datetime"] = this.iso8601(timestamp);
        object symbol = getValue(ticker, "symbol");
        ((IDictionary<string,object>)this.tickers)[(string)symbol] = ticker;
        callDynamically(client as WebSocketClient, "resolve", new object[] {ticker, ch});
        return message;
    }

    /**
     * @method
     * @name huobijp#watchTrades
     * @description get the list of most recent trades for a particular symbol
     * @param {string} symbol unified symbol of the market to fetch trades for
     * @param {int} [since] timestamp in ms of the earliest trade to fetch
     * @param {int} [limit] the maximum amount of trades to fetch
     * @param {object} [params] extra parameters specific to the exchange API endpoint
     * @returns {object[]} a list of [trade structures]{@link https://docs.ccxt.com/#/?id=public-trades}
     */
    public async override Task<object> watchTrades(object symbol, object since = null, object limit = null, object parameters = null)
    {
        parameters ??= new Dictionary<string, object>();
        await this.loadMarkets();
        object market = this.market(symbol);
        symbol = getValue(market, "symbol");
        // only supports a limit of 150 at this time
        object messageHash = add(add("market.", getValue(market, "id")), ".trade.detail");
        object api = this.safeString(this.options, "api", "api");
        object hostname = new Dictionary<string, object>() {
            { "hostname", this.hostname },
        };
        object url = this.implodeParams(getValue(getValue(getValue(getValue(this.urls, "api"), "ws"), api), "public"), hostname);
        object requestId = this.requestId();
        object request = new Dictionary<string, object>() {
            { "sub", messageHash },
            { "id", requestId },
        };
        object subscription = new Dictionary<string, object>() {
            { "id", requestId },
            { "messageHash", messageHash },
            { "symbol", symbol },
            { "params", parameters },
        };
        object trades = await this.watch(url, messageHash, this.extend(request, parameters), messageHash, subscription);
        if (isTrue(this.newUpdates))
        {
            limit = callDynamically(trades, "getLimit", new object[] {symbol, limit});
        }
        return this.filterBySinceLimit(trades, since, limit, "timestamp", true);
    }

    public virtual object handleTrades(WebSocketClient client, object message)
    {
        //
        //     {
        //         "ch": "market.btcusdt.trade.detail",
        //         "ts": 1583495834011,
        //         "tick": {
        //             "id": 105004645372,
        //             "ts": 1583495833751,
        //             "data": [
        //                 {
        //                     "id": 1.050046453727319e+22,
        //                     "ts": 1583495833751,
        //                     "tradeId": 102090727790,
        //                     "amount": 0.003893,
        //                     "price": 9150.01,
        //                     "direction": "sell"
        //                 }
        //             ]
        //         }
        //     }
        //
        object tick = this.safeValue(message, "tick", new Dictionary<string, object>() {});
        object data = this.safeValue(tick, "data", new Dictionary<string, object>() {});
        object ch = this.safeString(message, "ch");
        object parts = ((string)ch).Split(new [] {((string)".")}, StringSplitOptions.None).ToList<object>();
        object marketId = this.safeString(parts, 1);
        object market = this.safeMarket(marketId);
        object symbol = getValue(market, "symbol");
        object tradesCache = this.safeValue(this.trades, symbol);
        if (isTrue(isEqual(tradesCache, null)))
        {
            object limit = this.safeInteger(this.options, "tradesLimit", 1000);
            tradesCache = new ArrayCache(limit);
            ((IDictionary<string,object>)this.trades)[(string)symbol] = tradesCache;
        }
        for (object i = 0; isLessThan(i, getArrayLength(data)); postFixIncrement(ref i))
        {
            object trade = this.parseTrade(getValue(data, i), market);
            callDynamically(tradesCache, "append", new object[] {trade});
        }
        callDynamically(client as WebSocketClient, "resolve", new object[] {tradesCache, ch});
        return message;
    }

    /**
     * @method
     * @name huobijp#watchOHLCV
     * @description watches historical candlestick data containing the open, high, low, and close price, and the volume of a market
     * @param {string} symbol unified symbol of the market to fetch OHLCV data for
     * @param {string} timeframe the length of time each candle represents
     * @param {int} [since] timestamp in ms of the earliest candle to fetch
     * @param {int} [limit] the maximum amount of candles to fetch
     * @param {object} [params] extra parameters specific to the exchange API endpoint
     * @returns {int[][]} A list of candles ordered as timestamp, open, high, low, close, volume
     */
    public async override Task<object> watchOHLCV(object symbol, object timeframe = null, object since = null, object limit = null, object parameters = null)
    {
        timeframe ??= "1m";
        parameters ??= new Dictionary<string, object>();
        await this.loadMarkets();
        object market = this.market(symbol);
        symbol = getValue(market, "symbol");
        object interval = this.safeString(this.timeframes, timeframe, timeframe);
        object messageHash = add(add(add("market.", getValue(market, "id")), ".kline."), interval);
        object api = this.safeString(this.options, "api", "api");
        object hostname = new Dictionary<string, object>() {
            { "hostname", this.hostname },
        };
        object url = this.implodeParams(getValue(getValue(getValue(getValue(this.urls, "api"), "ws"), api), "public"), hostname);
        object requestId = this.requestId();
        object request = new Dictionary<string, object>() {
            { "sub", messageHash },
            { "id", requestId },
        };
        object subscription = new Dictionary<string, object>() {
            { "id", requestId },
            { "messageHash", messageHash },
            { "symbol", symbol },
            { "timeframe", timeframe },
            { "params", parameters },
        };
        object ohlcv = await this.watch(url, messageHash, this.extend(request, parameters), messageHash, subscription);
        if (isTrue(this.newUpdates))
        {
            limit = callDynamically(ohlcv, "getLimit", new object[] {symbol, limit});
        }
        return this.filterBySinceLimit(ohlcv, since, limit, 0, true);
    }

    public virtual void handleOHLCV(WebSocketClient client, object message)
    {
        //
        //     {
        //         "ch": "market.btcusdt.kline.1min",
        //         "ts": 1583501786794,
        //         "tick": {
        //             "id": 1583501760,
        //             "open": 9094.5,
        //             "close": 9094.51,
        //             "low": 9094.5,
        //             "high": 9094.51,
        //             "amount": 0.44639786263800907,
        //             "vol": 4059.76919054,
        //             "count": 16
        //         }
        //     }
        //
        object ch = this.safeString(message, "ch");
        object parts = ((string)ch).Split(new [] {((string)".")}, StringSplitOptions.None).ToList<object>();
        object marketId = this.safeString(parts, 1);
        object market = this.safeMarket(marketId);
        object symbol = getValue(market, "symbol");
        object interval = this.safeString(parts, 3);
        object timeframe = this.findTimeframe(interval);
        ((IDictionary<string,object>)this.ohlcvs)[(string)symbol] = this.safeValue(this.ohlcvs, symbol, new Dictionary<string, object>() {});
        object stored = this.safeValue(getValue(this.ohlcvs, symbol), timeframe);
        if (isTrue(isEqual(stored, null)))
        {
            object limit = this.safeInteger(this.options, "OHLCVLimit", 1000);
            stored = new ArrayCacheByTimestamp(limit);
            ((IDictionary<string,object>)getValue(this.ohlcvs, symbol))[(string)timeframe] = stored;
        }
        object tick = this.safeValue(message, "tick");
        object parsed = this.parseOHLCV(tick, market);
        callDynamically(stored, "append", new object[] {parsed});
        callDynamically(client as WebSocketClient, "resolve", new object[] {stored, ch});
    }

    /**
     * @method
     * @name huobijp#watchOrderBook
     * @description watches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
     * @param {string} symbol unified symbol of the market to fetch the order book for
     * @param {int} [limit] the maximum amount of order book entries to return
     * @param {object} [params] extra parameters specific to the exchange API endpoint
     * @returns {object} A dictionary of [order book structures]{@link https://docs.ccxt.com/#/?id=order-book-structure} indexed by market symbols
     */
    public async override Task<object> watchOrderBook(object symbol, object limit = null, object parameters = null)
    {
        parameters ??= new Dictionary<string, object>();
        if (isTrue(isTrue((!isEqual(limit, null))) && isTrue((!isEqual(limit, 150)))))
        {
            throw new ExchangeError ((string)add(this.id, " watchOrderBook accepts limit = 150 only")) ;
        }
        await this.loadMarkets();
        object market = this.market(symbol);
        symbol = getValue(market, "symbol");
        // only supports a limit of 150 at this time
        limit = ((bool) isTrue((isEqual(limit, null)))) ? 150 : limit;
        object messageHash = add(add(add("market.", getValue(market, "id")), ".mbp."), ((object)limit).ToString());
        object api = this.safeString(this.options, "api", "api");
        object hostname = new Dictionary<string, object>() {
            { "hostname", this.hostname },
        };
        object url = this.implodeParams(getValue(getValue(getValue(getValue(this.urls, "api"), "ws"), api), "public"), hostname);
        object requestId = this.requestId();
        object request = new Dictionary<string, object>() {
            { "sub", messageHash },
            { "id", requestId },
        };
        object subscription = new Dictionary<string, object>() {
            { "id", requestId },
            { "messageHash", messageHash },
            { "symbol", symbol },
            { "limit", limit },
            { "params", parameters },
            { "method", this.handleOrderBookSubscription },
        };
        object orderbook = await this.watch(url, messageHash, this.extend(request, parameters), messageHash, subscription);
        return (orderbook as IOrderBook).limit();
    }

    public virtual void handleOrderBookSnapshot(WebSocketClient client, object message, object subscription)
    {
        //
        //     {
        //         "id": 1583473663565,
        //         "rep": "market.btcusdt.mbp.150",
        //         "status": "ok",
        //         "data": {
        //             "seqNum": 104999417756,
        //             "bids": [
        //                 [9058.27, 0],
        //                 [9058.43, 0],
        //                 [9058.99, 0],
        //             ],
        //             "asks": [
        //                 [9084.27, 0.2],
        //                 [9085.69, 0],
        //                 [9085.81, 0],
        //             ]
        //         }
        //     }
        //
        object symbol = this.safeString(subscription, "symbol");
        object messageHash = this.safeString(subscription, "messageHash");
        object orderbook = getValue(this.orderbooks, symbol);
        object data = this.safeValue(message, "data");
        object snapshot = this.parseOrderBook(data, symbol);
        ((IDictionary<string,object>)snapshot)["nonce"] = this.safeInteger(data, "seqNum");
        (orderbook as IOrderBook).reset(snapshot);
        // unroll the accumulated deltas
        object messages = (orderbook as ccxt.pro.OrderBook).cache;
        for (object i = 0; isLessThan(i, getArrayLength(messages)); postFixIncrement(ref i))
        {
            this.handleOrderBookMessage(client as WebSocketClient, getValue(messages, i), orderbook);
        }
        ((IDictionary<string,object>)this.orderbooks)[(string)symbol] = orderbook;
        callDynamically(client as WebSocketClient, "resolve", new object[] {orderbook, messageHash});
    }

    public async virtual Task<object> watchOrderBookSnapshot(WebSocketClient client, object message, object subscription)
    {
        object messageHash = this.safeString(subscription, "messageHash");
        try
        {
            object symbol = this.safeString(subscription, "symbol");
            object limit = this.safeInteger(subscription, "limit");
            object parameters = this.safeValue(subscription, "params");
            object api = this.safeString(this.options, "api", "api");
            object hostname = new Dictionary<string, object>() {
                { "hostname", this.hostname },
            };
            object url = this.implodeParams(getValue(getValue(getValue(getValue(this.urls, "api"), "ws"), api), "public"), hostname);
            object requestId = this.requestId();
            object request = new Dictionary<string, object>() {
                { "req", messageHash },
                { "id", requestId },
            };
            // this is a temporary subscription by a specific requestId
            // it has a very short lifetime until the snapshot is received over ws
            object snapshotSubscription = new Dictionary<string, object>() {
                { "id", requestId },
                { "messageHash", messageHash },
                { "symbol", symbol },
                { "limit", limit },
                { "params", parameters },
                { "method", this.handleOrderBookSnapshot },
            };
            object orderbook = await this.watch(url, requestId, request, requestId, snapshotSubscription);
            return (orderbook as IOrderBook).limit();
        } catch(Exception e)
        {
            ((IDictionary<string,object>)((WebSocketClient)client).subscriptions).Remove((string)messageHash);
            ((WebSocketClient)client).reject(e, messageHash);
        }
        return null;
    }

    public override void handleDelta(object bookside, object delta)
    {
        object price = this.safeFloat(delta, 0);
        object amount = this.safeFloat(delta, 1);
        (bookside as IOrderBookSide).store(price, amount);
    }

    public override void handleDeltas(object bookside, object deltas)
    {
        for (object i = 0; isLessThan(i, getArrayLength(deltas)); postFixIncrement(ref i))
        {
            this.handleDelta(bookside, getValue(deltas, i));
        }
    }

    public virtual object handleOrderBookMessage(WebSocketClient client, object message, object orderbook)
    {
        //
        //     {
        //         "ch": "market.btcusdt.mbp.150",
        //         "ts": 1583472025885,
        //         "tick": {
        //             "seqNum": 104998984994,
        //             "prevSeqNum": 104998984977,
        //             "bids": [
        //                 [9058.27, 0],
        //                 [9058.43, 0],
        //                 [9058.99, 0],
        //             ],
        //             "asks": [
        //                 [9084.27, 0.2],
        //                 [9085.69, 0],
        //                 [9085.81, 0],
        //             ]
        //         }
        //     }
        //
        object tick = this.safeValue(message, "tick", new Dictionary<string, object>() {});
        object seqNum = this.safeInteger(tick, "seqNum");
        object prevSeqNum = this.safeInteger(tick, "prevSeqNum");
        if (isTrue(isTrue((isLessThanOrEqual(prevSeqNum, getValue(orderbook, "nonce")))) && isTrue((isGreaterThan(seqNum, getValue(orderbook, "nonce"))))))
        {
            object asks = this.safeValue(tick, "asks", new List<object>() {});
            object bids = this.safeValue(tick, "bids", new List<object>() {});
            this.handleDeltas(getValue(orderbook, "asks"), asks);
            this.handleDeltas(getValue(orderbook, "bids"), bids);
            ((IDictionary<string,object>)orderbook)["nonce"] = seqNum;
            object timestamp = this.safeInteger(message, "ts");
            ((IDictionary<string,object>)orderbook)["timestamp"] = timestamp;
            ((IDictionary<string,object>)orderbook)["datetime"] = this.iso8601(timestamp);
        }
        return orderbook;
    }

    public virtual void handleOrderBook(WebSocketClient client, object message)
    {
        //
        // deltas
        //
        //     {
        //         "ch": "market.btcusdt.mbp.150",
        //         "ts": 1583472025885,
        //         "tick": {
        //             "seqNum": 104998984994,
        //             "prevSeqNum": 104998984977,
        //             "bids": [
        //                 [9058.27, 0],
        //                 [9058.43, 0],
        //                 [9058.99, 0],
        //             ],
        //             "asks": [
        //                 [9084.27, 0.2],
        //                 [9085.69, 0],
        //                 [9085.81, 0],
        //             ]
        //         }
        //     }
        //
        object messageHash = this.safeString(message, "ch");
        object ch = this.safeValue(message, "ch");
        object parts = ((string)ch).Split(new [] {((string)".")}, StringSplitOptions.None).ToList<object>();
        object marketId = this.safeString(parts, 1);
        object symbol = this.safeSymbol(marketId);
        object orderbook = getValue(this.orderbooks, symbol);
        if (isTrue(isEqual(getValue(orderbook, "nonce"), null)))
        {
            ((IList<object>)(orderbook as ccxt.pro.OrderBook).cache).Add(message);
        } else
        {
            this.handleOrderBookMessage(client as WebSocketClient, message, orderbook);
            callDynamically(client as WebSocketClient, "resolve", new object[] {orderbook, messageHash});
        }
    }

    public virtual void handleOrderBookSubscription(WebSocketClient client, object message, object subscription)
    {
        object symbol = this.safeString(subscription, "symbol");
        object limit = this.safeInteger(subscription, "limit");
        if (isTrue(inOp(this.orderbooks, symbol)))
        {
            ((IDictionary<string,object>)this.orderbooks).Remove((string)symbol);
        }
        ((IDictionary<string,object>)this.orderbooks)[(string)symbol] = this.orderBook(new Dictionary<string, object>() {}, limit);
        // watch the snapshot in a separate async call
        this.spawn(this.watchOrderBookSnapshot, new object[] { client, message, subscription});
    }

    public virtual object handleSubscriptionStatus(WebSocketClient client, object message)
    {
        //
        //     {
        //         "id": 1583414227,
        //         "status": "ok",
        //         "subbed": "market.btcusdt.mbp.150",
        //         "ts": 1583414229143
        //     }
        //
        object id = this.safeString(message, "id");
        object subscriptionsById = this.indexBy(((WebSocketClient)client).subscriptions, "id");
        object subscription = this.safeValue(subscriptionsById, id);
        if (isTrue(!isEqual(subscription, null)))
        {
            object method = this.safeValue(subscription, "method");
            if (isTrue(!isEqual(method, null)))
            {
                return DynamicInvoker.InvokeMethod(method, new object[] { client, message, subscription});
            }
            // clean up
            if (isTrue(inOp(((WebSocketClient)client).subscriptions, id)))
            {
                ((IDictionary<string,object>)((WebSocketClient)client).subscriptions).Remove((string)id);
            }
        }
        return message;
    }

    public virtual object handleSystemStatus(WebSocketClient client, object message)
    {
        //
        // todo: answer the question whether handleSystemStatus should be renamed
        // and unified as handleStatus for any usage pattern that
        // involves system status and maintenance updates
        //
        //     {
        //         "id": "1578090234088", // connectId
        //         "type": "welcome",
        //     }
        //
        return message;
    }

    public virtual void handleSubject(WebSocketClient client, object message)
    {
        //
        //     {
        //         "ch": "market.btcusdt.mbp.150",
        //         "ts": 1583472025885,
        //         "tick": {
        //             "seqNum": 104998984994,
        //             "prevSeqNum": 104998984977,
        //             "bids": [
        //                 [9058.27, 0],
        //                 [9058.43, 0],
        //                 [9058.99, 0],
        //             ],
        //             "asks": [
        //                 [9084.27, 0.2],
        //                 [9085.69, 0],
        //                 [9085.81, 0],
        //             ]
        //         }
        //     }
        //
        object ch = this.safeValue(message, "ch");
        object parts = ((string)ch).Split(new [] {((string)".")}, StringSplitOptions.None).ToList<object>();
        object type = this.safeString(parts, 0);
        if (isTrue(isEqual(type, "market")))
        {
            object methodName = this.safeString(parts, 2);
            object methods = new Dictionary<string, object>() {
                { "mbp", this.handleOrderBook },
                { "detail", this.handleTicker },
                { "trade", this.handleTrades },
                { "kline", this.handleOHLCV },
            };
            object method = this.safeValue(methods, methodName);
            if (isTrue(!isEqual(method, null)))
            {
                DynamicInvoker.InvokeMethod(method, new object[] { client, message});
            }
        }
    }

    public async virtual Task pong(WebSocketClient client, object message)
    {
        //
        //     { ping: 1583491673714 }
        //
        await client.send(new Dictionary<string, object>() {
            { "pong", this.safeInteger(message, "ping") },
        });
    }

    public virtual void handlePing(WebSocketClient client, object message)
    {
        this.spawn(this.pong, new object[] { client, message});
    }

    public virtual object handleErrorMessage(WebSocketClient client, object message)
    {
        //
        //     {
        //         "ts": 1586323747018,
        //         "status": "error",
        //         'err-code': "bad-request",
        //         'err-msg': "invalid mbp.150.symbol linkusdt",
        //         "id": "2"
        //     }
        //
        object status = this.safeString(message, "status");
        if (isTrue(isEqual(status, "error")))
        {
            object id = this.safeString(message, "id");
            object subscriptionsById = this.indexBy(((WebSocketClient)client).subscriptions, "id");
            object subscription = this.safeValue(subscriptionsById, id);
            if (isTrue(!isEqual(subscription, null)))
            {
                object errorCode = this.safeString(message, "err-code");
                try
                {
                    this.throwExactlyMatchedException(getValue(this.exceptions, "exact"), errorCode, this.json(message));
                } catch(Exception e)
                {
                    object messageHash = this.safeString(subscription, "messageHash");
                    ((WebSocketClient)client).reject(e, messageHash);
                    ((WebSocketClient)client).reject(e, id);
                    if (isTrue(inOp(((WebSocketClient)client).subscriptions, id)))
                    {
                        ((IDictionary<string,object>)((WebSocketClient)client).subscriptions).Remove((string)id);
                    }
                }
            }
            return false;
        }
        return message;
    }

    public override void handleMessage(WebSocketClient client, object message)
    {
        if (isTrue(this.handleErrorMessage(client as WebSocketClient, message)))
        {
            //
            //     {"id":1583414227,"status":"ok","subbed":"market.btcusdt.mbp.150","ts":1583414229143}
            //
            //           ________________________
            //
            // sometimes huobijp responds with half of a JSON response like
            //
            //     " {"ch":"market.ethbtc.m "
            //
            // this is passed to handleMessage as a string since it failed to be decoded as JSON
            //
            if (isTrue(!isEqual(this.safeString(message, "id"), null)))
            {
                this.handleSubscriptionStatus(client as WebSocketClient, message);
            } else if (isTrue(!isEqual(this.safeString(message, "ch"), null)))
            {
                // route by channel aka topic aka subject
                this.handleSubject(client as WebSocketClient, message);
            } else if (isTrue(!isEqual(this.safeString(message, "ping"), null)))
            {
                this.handlePing(client as WebSocketClient, message);
            }
        }
    }
}