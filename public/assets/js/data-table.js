"use strict";
/**
 *
 *
 * By Rakhmadi (c) 2021
 * Under the MIT License.
 *
 * Fixed for multiple instances support - FINAL VERSION
 *
 */
class RdataTB {
    constructor(
        IdTable,
        Options = {
            RenderJSON: null,
            ShowSearch: true,
            ShowSelect: true,
            ShowPaginate: true,
            SelectionNumber: [10, 15, 20, 50],
            HideColumn: [],
            ShowHighlight: false,
            fixedTable: false,
            sortAnimate: true,
            ShowTfoot: false,
            ExcludeColumnExport: [],
        },
    ) {
        // Generate unique instance ID FIRST
        this.instanceId =
            IdTable + "_" + Math.random().toString(36).substr(2, 9);

        // Initialize properties
        this.HeaderDataTable = [];
        this.RowDataTable = [];
        this.DataTable = [];
        this.DataSorted = [];
        this.DataToRender = [];
        this.PageSize = 10;
        this.Assc = false;
        this.DataSearch = [];
        this.i = 0;
        this.COntrolDataArr = [];
        this.DataTableRaw = [];
        this.searchValue = "";
        this.ListHiding = [];
        this.SelectionNumber = [10, 15, 20, 50];
        this.SelectElementString = "";
        this.ShowHighlight = false;
        this.listTypeDate = [];
        this.PageNow = 1;
        this.ExcludeColumnExport = [];

        this.TableElement = document.getElementById(IdTable);
        this.Options = Options;

        // Execute initialization methods - HANYA SEKALI!
        this.detectTyped();
        this.StyleS();
        this.ConvertToJson();
        this.paginateRender();
        this.Control();
        this.search();
        this.RenderToHTML();
        this.PaginateUpdate();

        // Handle options
        if (
            Options.RenderJSON != null &&
            Options.hasOwnProperty("RenderJSON")
        ) {
            this.JSONinit(Options.RenderJSON);
        }

        if (!Options.ShowSelect && Options.hasOwnProperty("ShowSelect")) {
            const selectEl = document.getElementById(
                `my-select-${this.instanceId}`,
            );
            if (selectEl) selectEl.remove();
        }

        this.ShowHighlight = Options?.ShowHighlight;

        if (Options.fixedTable && Options.hasOwnProperty("fixedTable")) {
            this.TableElement?.classList.add("table_layout_fixed");
        } else {
            this.TableElement?.classList.remove("table_layout_fixed");
        }

        if (!Options.ShowSearch && Options.hasOwnProperty("ShowSearch")) {
            const searchEl = document.getElementById(
                `SearchControl-${this.instanceId}`,
            );
            if (searchEl) searchEl.remove();
        }

        if (
            Options.HideColumn != null &&
            Options.hasOwnProperty("HideColumn")
        ) {
            this.ListHiding = Options.HideColumn;
            this.DoHide();
        }

        if (
            Options.SelectionNumber != null &&
            Options.hasOwnProperty("SelectionNumber")
        ) {
            this.SelectionNumber = Options.SelectionNumber;
            this.ChangeSelect();
        }

        this.totalPages = this.Divide().length;
    }

    detectTyped() {
        const getHead = this.TableElement?.getElementsByTagName("th");
        if (!getHead) return;

        for (let z = 0; z < getHead.length; z++) {
            if (getHead[z].attributes["type-date"]) {
                this.listTypeDate.push({
                    HeaderIndex: z,
                    dateVal: true,
                });
            }
        }
    }

    StyleS() {
        if (document.getElementById("rdatatb-styles")) {
            return;
        }

        const style = document.createElement("style");
        style.id = "rdatatb-styles";
        style.innerHTML = `
        .table_layout_fixed {
            table-layout:fixed;
        }
        table > thead{
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .pagination a {
          color: black;
          float: left;
          padding: 8px 12px;
          text-decoration: none;
          transition: background-color .3s;
          font-size:12px;
          cursor: pointer;
        }
        .tablesorter-header-asc::after {
            content: "\\f326";
            font-family: remixicon!important;
        }
        .tablesorter-header-desc::after {
            content: "\\f326";
            font-family: remixicon!important;
        }
        .pagination a:hover:not(.active) {background-color: #ddd;}
        .blink_me {
            animation: blinker 1s;
          }
          @keyframes blinker {
            50% {
              opacity: .5;
            }
          }
          `;
        document.getElementsByTagName("head")[0].appendChild(style);
    }

    ChangeSelect() {
        this.SelectElementString = "";
        for (let x = 0; x < this.SelectionNumber.length; x++) {
            this.SelectElementString += `<option value="${this.SelectionNumber[x]}">${this.SelectionNumber[x]}</option>`;
        }
        let ElSelect = document.getElementById(`my-select-${this.instanceId}`);
        if (ElSelect) {
            ElSelect.innerHTML = this.SelectElementString;
        }
        return this.SelectElementString;
    }

    Control() {
        const span1 = document.createElement("span");
        span1.innerHTML = `
            <table id="C_${this.instanceId}" border="0" style="width:100%;margin-bottom:12px;">
            <tr>
                <td style="width:100%; display: flex; justify-content: space-between; padding: 20px;">
                    <select id="my-select-${this.instanceId}" class="form-select shadow-none" style="float:left;width:99px!important;margin-right:10px;">
                    <option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="50">50</option>
                    </select>
                    <input id="SearchControl-${this.instanceId}" class="form-control shadow-none" placeholder="Search" type="text" style="width: 145px;height:40px">
                </td>
            </tr>
            </table>
        `;
        span1.className = "Selc";
        this.TableElement.parentNode.insertBefore(span1, this.TableElement);
        this.TableElement.style.width = "100%";

        const ChangeV = (params) => {
            this.PageSize = params;
            this.i = 0;
            this.RenderToHTML();
        };

        let selectEl = document.getElementById(`my-select-${this.instanceId}`);
        if (selectEl) {
            selectEl.addEventListener("change", function () {
                ChangeV(this.value);
            });
        }

        const nextBtn = document.getElementById(
            `x__NEXT__X-${this.instanceId}`,
        );
        const prevBtn = document.getElementById(
            `x__PREV__X-${this.instanceId}`,
        );

        if (nextBtn) {
            nextBtn.onclick = () => {
                this.nextItem();
                this.highlight(this.searchValue);
                this.DoHide();
            };
        }

        if (prevBtn) {
            prevBtn.onclick = () => {
                this.prevItem();
                this.highlight(this.searchValue);
                this.DoHide();
            };
        }
    }

    nextItem() {
        this.i = this.i + 1;
        this.i = this.i % this.Divide().length;
        this.COntrolDataArr = this.Divide()[this.i];
        this.RenderToHTML(this.COntrolDataArr);
        this.PageNow = this.i + 1;
    }

    prevItem() {
        if (this.i === 0) {
            this.i = this.Divide().length;
        }
        this.i = this.i - 1;
        this.PageNow = this.i + 1;
        this.COntrolDataArr = this.Divide()[this.i];
        this.RenderToHTML(this.COntrolDataArr);
    }

    paginateRender() {
        const k = `
        <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 p-20">
            <div class="fs-16 fw-normal" id="PF-${this.instanceId}"></div>

            <div class="pagination overflow-hidden" id="pgN-${this.instanceId}">
                <nav class="custom-pagination" aria-label="Page navigation example">
                    <ul class="pagination mb-0 justify-content-center align-items-center">
                        <li class="page-item">
                            <a class="page-link icon" aria-label="Previous" id="x__PREV__X-${this.instanceId}">
                                <i class="material-symbols-outlined">west</i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link icon" aria-label="Next" id="x__NEXT__X-${this.instanceId}">
                                <i class="material-symbols-outlined">east</i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        `;
        const span = document.createElement("span");
        span.innerHTML = k;
        span.className = "asterisk";
        this.TableElement.parentNode.insertBefore(
            span,
            this.TableElement.nextSibling,
        );
    }

    PaginateUpdate() {
        const pfElement = document.getElementById(`PF-${this.instanceId}`);
        if (pfElement != null) {
            pfElement.innerHTML = `
            <a style="">Page ${this.i + 1} to ${this.Divide().length} of ${this.DataTable === undefined ? 0 : this.DataTable.length} Entries</a>`;
        }
    }

    search() {
        this.DataSearch = this.DataTable;
        const searchEl = document.getElementById(
            `SearchControl-${this.instanceId}`,
        );
        if (searchEl) {
            searchEl.addEventListener("input", (evt) => {
                this.searchValue = evt.target.value;
                this.DataTable = this.DataSearch.filter((element) => {
                    for (
                        let index = 0;
                        index < this.HeaderDataTable.length;
                        index++
                    ) {
                        const fg = element[this.HeaderDataTable[index]]
                            .toString()
                            .toLowerCase()
                            .includes(evt.target.value.toLowerCase());
                        if (fg) {
                            return fg;
                        }
                    }
                });
                this.RenderToHTML();
                this.i = 0;
                this.PaginateUpdate();
                this.highlight(evt.target.value);
            });
        }
    }

    ConvertToJson() {
        const getHead = this.TableElement?.getElementsByTagName("th");
        if (!getHead) return;

        for (let v = 0; v < getHead.length; v++) {
            this.HeaderDataTable?.push(getHead[v].textContent);
        }

        const getbody = this.TableElement?.getElementsByTagName("tbody");
        if (!getbody || !getbody[0]) return;

        for (let row = 0; row < getbody[0].rows.length; row++) {
            const cellsD = [];
            for (
                let cellsIndex = 0;
                cellsIndex < getbody[0].rows[row].cells.length;
                cellsIndex++
            ) {
                cellsD.push(getbody[0].rows[row].cells[cellsIndex].innerHTML);
            }
            this.RowDataTable.push(cellsD);
        }

        this.DataTable = this.RowDataTable.reduce((akumulasi, e) => {
            akumulasi.push(
                this.HeaderDataTable.reduce((x, y, i) => {
                    x[y] = e[i];
                    return x;
                }, {}),
            );
            return akumulasi;
        }, []);
        this.DataTableRaw = this.DataTable;
        return this.DataTable;
    }

    Divide() {
        const gh = [];
        const h =
            typeof this.PageSize === "string"
                ? parseInt(this.PageSize)
                : this.PageSize;
        for (
            let i = 0;
            i < (this.DataTable === undefined ? 0 : this.DataTable.length);
            i += h
        ) {
            gh.push(this.DataTable.slice(i, i + h));
        }
        return gh;
    }

    RenderToHTML(SlecTloaf = null) {
        if (!this.TableElement) return;

        this.TableElement.innerHTML = "";

        const CheckIFSorted =
            this.DataSorted === null || this.DataSorted === undefined
                ? this.Divide()[0]
                : this.Divide()[0];
        this.DataToRender = CheckIFSorted;

        if (!this.DataToRender) return;

        let header = "";
        let footer = "";
        for (let I = 0; I < this.HeaderDataTable.length; I++) {
            header += `<th style="cursor: pointer;" id="${this.HeaderDataTable[I]}_header_${this.instanceId}" class="columns tablesorter-header">${this.HeaderDataTable[I]}</th>\n`;
            footer += `<th style="cursor: pointer;" id="${this.HeaderDataTable[I]}_footer_${this.instanceId}" class="columns tablesorter-header">${this.HeaderDataTable[I]}</th>\n`;
        }

        const ifUndefinded =
            this.DataToRender === undefined ? 0 : this.DataToRender.length;
        let row = "";
        if (SlecTloaf === null) {
            for (let ___row = 0; ___row < ifUndefinded; ___row++) {
                let ToCell = "";
                for (
                    let ___cell = 0;
                    ___cell < this.HeaderDataTable.length;
                    ___cell++
                ) {
                    ToCell += `<td class="${this.HeaderDataTable[___cell]}__row_${this.instanceId}">${this.DataToRender[___row][this.HeaderDataTable[___cell]]}</td>\n`;
                }
                row += `<tr>${ToCell}</tr>\n`;
            }
        } else {
            for (let ___row = 0; ___row < SlecTloaf.length; ___row++) {
                let ToCell = "";
                for (
                    let ___cell = 0;
                    ___cell < this.HeaderDataTable.length;
                    ___cell++
                ) {
                    ToCell += `<td class="${this.HeaderDataTable[___cell]}__row_${this.instanceId}">${SlecTloaf[___row][this.HeaderDataTable[___cell]]}</td>\n`;
                }
                row += `<tr>${ToCell}</tr>\n`;
            }
            this.DataToRender = SlecTloaf;
        }

        let ToEl = `<thead><tr>${header}</tr></thead><tbody>${row}</tbody>`;
        if (this.Options.ShowTfoot) {
            ToEl += `<tfoot>${footer}</tfoot>`;
        }
        this.TableElement.innerHTML = ToEl;

        for (let n = 0; n < this.HeaderDataTable.length; n++) {
            const cv = document.getElementById(
                `${this.HeaderDataTable[n]}_header_${this.instanceId}`,
            );
            if (cv) {
                cv.style.opacity = "100%";
                cv.onclick = () => {
                    this.sort(this.HeaderDataTable[n]);
                    let GetElsHeaderList = document.getElementById(
                        `${this.HeaderDataTable[n]}_header_${this.instanceId}`,
                    );
                    if (GetElsHeaderList) {
                        GetElsHeaderList.style.opacity = "100%";
                        if (this.Assc) {
                            GetElsHeaderList.classList.remove(
                                "tablesorter-header-asc",
                            );
                            GetElsHeaderList.classList.add(
                                "tablesorter-header-desc",
                            );
                        } else {
                            GetElsHeaderList.classList.remove(
                                "tablesorter-header-desc",
                            );
                            GetElsHeaderList.classList.add(
                                "tablesorter-header-asc",
                            );
                        }
                    }

                    if (this.Options.sortAnimate) {
                        const s = document.getElementsByClassName(
                            `${this.HeaderDataTable[n]}__row_${this.instanceId}`,
                        );
                        for (let NN = 0; NN < s.length; NN++) {
                            setTimeout(
                                () => s[NN].classList.add("blink_me"),
                                21 * NN,
                            );
                        }
                    }
                };
            }
        }
        this.PaginateUpdate();
        this.DoHide();
    }

    sort(column) {
        const t0 = performance.now();
        function naturalCompare(a, b) {
            const ax = [];
            const bx = [];
            a.toString()
                .replace(/(^\$|,)/g, "")
                .replace(/(\d+)|(\D+)/g, function (_, $1, $2) {
                    ax.push([$1 || Infinity, $2 || ""]);
                });
            b.toString()
                .replace(/(^\$|,)/g, "")
                .replace(/(\d+)|(\D+)/g, function (_, $1, $2) {
                    bx.push([$1 || Infinity, $2 || ""]);
                });
            for (let index = 0; ax.length && bx.length; index++) {
                const an = ax.shift();
                const bn = bx.shift();
                const nn = an[0] - bn[0] || an[1].localeCompare(bn[1]);
                if (nn) return nn;
            }
            return ax.length - bx.length;
        }
        const IndexHead = this.HeaderDataTable.indexOf(column);
        const listDated = this.listTypeDate.find(
            (x) => x.HeaderIndex === IndexHead,
        );
        const isDate = listDated?.HeaderIndex === IndexHead;
        const data = this.DataTable;
        if (this.Assc) {
            this.Assc = !this.Assc;
            if (!isDate) {
                data.sort((a, b) => {
                    return naturalCompare(a[column], b[column]);
                });
            } else {
                data.sort((a, b) => {
                    return Date.parse(a[column]) - Date.parse(b[column]);
                });
            }
        } else {
            this.Assc = !this.Assc;
            if (!isDate) {
                data.sort((a, b) => {
                    return naturalCompare(b[column], a[column]);
                });
            } else {
                data.sort((a, b) => {
                    return Date.parse(b[column]) - Date.parse(a[column]);
                });
            }
        }
        this.DataSorted = data;
        this.i = 0;
        this.RenderToHTML();
        const t1 = performance.now();
        this.timeSort = Math.round(((t1 - t0) / 1000) * 10000) / 10000;
        return this.DataSorted;
    }

    MExcludeColumnExport() {
        let DataTable = JSON.parse(JSON.stringify(this.DataTable));
        let exlude = this.Options.ExcludeColumnExport;
        let head = [...this.HeaderDataTable];
        for (let x = 0; x < exlude.length; x++) {
            let indexHead = head.indexOf(exlude[x]);
            if (indexHead > -1) {
                head.splice(indexHead, 1);
            }
        }
        for (let x = 0; x < DataTable.length; x++) {
            for (let n = 0; n < exlude.length; n++) {
                delete DataTable[x][exlude[n]];
            }
        }
        return {
            header: head,
            data: DataTable,
        };
    }

    DownloadCSV(filename = "Export") {
        let data = this.MExcludeColumnExport();
        let str = "";
        let hed = data.header.toString();
        str = hed + "\r\n";
        for (let i = 0; i < data.data.length; i++) {
            let line = "";
            for (const index in data.data[i]) {
                if (line != "") line += ",";
                line += data.data[i][index];
            }
            str += line + "\r\n";
        }
        const element = document.createElement("a");
        element.href = "data:text/csv;charset=utf-8," + encodeURIComponent(str);
        element.target = "_blank";
        element.download = filename + ".csv";
        element.click();
    }

    DownloadJSON(filename = "Export") {
        let data = this.MExcludeColumnExport();
        const element = document.createElement("a");
        element.href =
            "data:text/json;charset=utf-8," +
            encodeURIComponent(JSON.stringify(data.data));
        element.target = "_blank";
        element.download = filename + ".json";
        element.click();
    }

    highlight(text) {
        if (this.ShowHighlight) {
            const getbody = this.TableElement?.getElementsByTagName("tbody");
            if (!getbody || !getbody[0]) return;

            for (let row = 0; row < getbody[0].rows.length; row++) {
                for (
                    let cellsIndex = 0;
                    cellsIndex < getbody[0].rows[row].cells.length;
                    cellsIndex++
                ) {
                    let innerHTML =
                        getbody[0].rows[row].cells[cellsIndex].innerHTML;
                    const index = innerHTML.indexOf(text);
                    if (index >= 0) {
                        innerHTML =
                            innerHTML.substring(0, index) +
                            "<span style='background-color: yellow;'>" +
                            innerHTML.substring(index, index + text.length) +
                            "</span>" +
                            innerHTML.substring(index + text.length);
                        getbody[0].rows[row].cells[cellsIndex].innerHTML =
                            innerHTML;
                        getbody[0].rows[row].cells[cellsIndex].classList.add(
                            `${this.HeaderDataTable[cellsIndex].replace(/\s/g, "_")}__row_${this.instanceId}`,
                        );
                    }
                }
            }
        }
    }

    JSONinit(PayLoad = []) {
        this.HeaderDataTable = [];
        for (const key in PayLoad[0]) {
            this.HeaderDataTable.push(key);
        }
        this.DataTable = PayLoad;
        this.DataSearch = PayLoad;
        this.RenderToHTML();
    }

    HideCol(column) {
        const Classes = document.getElementsByClassName(
            `${column}__row_${this.instanceId}`,
        );
        for (let O = 0; O < Classes.length; O++) {
            Classes[O].style.display = "none";
        }
        let ColmnHeader = document.getElementById(
            `${column}_header_${this.instanceId}`,
        );
        let ColmnFotter = document.getElementById(
            `${column}_footer_${this.instanceId}`,
        );
        if (ColmnHeader) {
            ColmnHeader.style.display = "none";
            if (ColmnFotter) {
                ColmnFotter.style.display = "none";
            }
        }
    }

    ShowCol(column) {
        const Classes = document.getElementsByClassName(
            `${column}__row_${this.instanceId}`,
        );
        for (let O = 0; O < Classes.length; O++) {
            Classes[O].style.display = "";
        }
        let ColmnHeader = document.getElementById(
            `${column}_header_${this.instanceId}`,
        );
        let ColmnFotter = document.getElementById(
            `${column}_footer_${this.instanceId}`,
        );
        if (ColmnHeader) {
            ColmnHeader.style.display = "";
            if (ColmnFotter) {
                ColmnFotter.style.display = "";
            }
        }
    }

    DoHide() {
        const GetHeadArr = this.HeaderDataTable;
        const ListOftrutc = [];
        for (let T = 0; T < this.HeaderDataTable.length; T++) {
            ListOftrutc.push(true);
        }
        for (let O = 0; O < this.ListHiding.length; O++) {
            const Index = GetHeadArr.indexOf(this.ListHiding[O]);
            if (Index > -1) {
                ListOftrutc[Index] = false;
            }
        }
        const IndexTrue = [];
        const IndexFalse = [];
        for (let U = 0; U < ListOftrutc.length; U++) {
            if (ListOftrutc[U]) {
                IndexTrue.push(U);
            }
            if (!ListOftrutc[U]) {
                IndexFalse.push(U);
            }
        }
        for (let V = 0; V < IndexTrue.length; V++) {
            this.ShowCol(GetHeadArr[IndexTrue[V]]);
        }
        for (let F = 0; F < IndexFalse.length; F++) {
            this.HideCol(GetHeadArr[IndexFalse[F]]);
        }
    }
}
