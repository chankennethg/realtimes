import axios from 'axios';
import { forEach } from 'lodash';
import select2 from 'select2';

class OverviewPage {

  constructor() {
    this.currentYear = new Date().getFullYear();
    this.oDataTable = null;
    this.model = {
      year: this.currentYear,
      param_id: null,
    }
  }

  initialize() {
    select2();
    this.renderYearSelect();
    this.getStatsTypeList();
    this.renderDataTable();
  }

  renderYearSelect() {
    const oYearSelect = $('#year').select2({
      placeholder: 'Select a year',
      data: this.generateYearData(2011),
    });

    oYearSelect.on('select2:select', (e) => {
      this.model.year = e.params.data.id;
      this.oDataTable.draw();
    });
  }

  renderStatsSelect(statsTypeList) {
    const oStatsSelect = $('#statistic').select2({
      data: statsTypeList,
      placeholder: 'Select a Statistic',
    });

    oStatsSelect.on('select2:select', (e) => {
      this.model.param_id = e.params.data.id;
      this.oDataTable.draw();
    });
  }

  renderDataTable() {
    this.oDataTable = $('#player-stats').DataTable({
      lengthMenu: [[25, 50], [25, 50]],
      pageLength: 25,
      serverSide: true,
      ordering: false,
      searching: false,
      processing: true,
      deferRender: true,
      ajax: {
        url: '/api/v1/match-stats',
        type: 'get',
        data: (d) => {
          d.year = this.model.year;
          d.param_id = this.model.param_id;
          if (d.start === 0) {
            d.page = 1;
          } else {
            d.page = (d.start / d.length) + 1;
          }
        },
        dataSrc: function(json) {
          json.recordsTotal = json.meta.total;
          json.recordsFiltered = json.meta.total;
          return json.data;
        },
        error: (error) => {
          toastr.error('Unable to retrieve Match stats. Please try again in a moment.');
          console.error(error);
        }
      },
      columns: [
        { data: 'player_name' },
        { data: 'param_name' },
        { data: 'value' },
        { data: 'year' },
      ]
    });
  }

  getModel() {
      return this.model;
  }

  generateYearData(startYear) {
    let currentYear = this.currentYear;
    let data = [];
    for (let year = startYear; year <= currentYear; currentYear--) {
      data.push({
        id: parseInt(currentYear),
        text: currentYear,
      });
    }
    return data;
  }

  async getStatsTypeList() {
    try {
      const response = await axios.get('/api/v1/stats-type');
      const statsTypeList = _.map(response.data.data, item => {
        return {
            id: item.param_id,
            text: item.param_name
        };
      });
      this.renderStatsSelect(statsTypeList);
    } catch (error) {
      toastr.error('Unable to get Statistics Types');
      console.error(error);
    }
  }
}

$(() => {
  let overviewPage = new OverviewPage();
  overviewPage.initialize();
});
